<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IslamicCalculations
{
    /**
     * Calculate the Qibla direction (bearing in degrees from North)
     * using the Great Circle navigation formula.
     * 
     * Kaaba Coordinates:
     * Latitude: 21.4225° N (0.37388 radians)
     * Longitude: 39.8262° E (0.69510 radians)
     */
    public function calculateQibla(float $latitude, float $longitude): float
    {
        // Kaaba coordinates in radians
        $latKaaba = deg2rad(21.4225);
        $lngKaaba = deg2rad(39.8262);

        // User coordinates in radians
        $latUser = deg2rad($latitude);
        $lngUser = deg2rad($longitude);

        // Longitude difference
        $dlng = $lngKaaba - $lngUser;

        // Great circle formula for bearing
        $y = sin($dlng);
        $x = (cos($latUser) * tan($latKaaba)) - (sin($latUser) * cos($dlng));

        $qiblaRad = atan2($y, $x);
        $qiblaDeg = rad2deg($qiblaRad);

        // Normalize bearing to 0-360 degrees
        return ($qiblaDeg + 360) % 360;
    }

    /**
     * Fetch prayer times from Aladhan API or use robust offline calculation.
     */
    public function getPrayerTimes(float $latitude, float $longitude, string $date, string $method = 'Karachi', string $madhab = 'Hanafi'): array
    {
        // Aladhan API accepts numeric methods. Let's map methods to API indices.
        // Karachi = 1, ISNA = 2, MWL = 3, Makkah = 4, Egypt = 5, Tehran = 7, Gulf = 8, Kuwait = 9, Qatar = 10, Singapore = 11, France = 12
        $methodMap = [
            'Karachi' => 1,
            'ISNA' => 2,
            'MWL' => 3,
            'Makkah' => 4,
            'Egypt' => 5,
            'Gulf' => 8,
        ];
        
        $apiMethod = $methodMap[$method] ?? 1;
        $apiSchool = strtolower($madhab) === 'hanafi' ? 1 : 0; // 1 = Hanafi, 0 = Shafi/others in Aladhan API

        try {
            $formattedDate = date('d-m-Y', strtotime($date));
            $response = Http::timeout(5)->get("https://api.aladhan.com/v1/timings/{$formattedDate}", [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'method' => $apiMethod,
                'school' => $apiSchool,
            ]);

            if ($response->successful()) {
                $timings = $response->json('data.timings');
                if ($timings) {
                    return [
                        'fajr' => $timings['Fajr'],
                        'dhuhr' => $timings['Dhuhr'],
                        'asr' => $timings['Asr'],
                        'maghrib' => $timings['Maghrib'],
                        'isha' => $timings['Isha'],
                        'sunrise' => $timings['Sunrise'],
                        'sunset' => $timings['Sunset'],
                        'source' => 'Aladhan API',
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::warning("Aladhan API request failed: " . $e->getMessage() . ". Falling back to offline estimation.");
        }

        // Offline Fallback Estimation (approximate based on standard latitude curves)
        return $this->estimatePrayerTimesOffline($latitude, $longitude, $date, $madhab);
    }

    /**
     * Standalone offline estimation of prayer times based on standard daylight approximations.
     */
    private function estimatePrayerTimesOffline(float $latitude, float $longitude, string $date, string $madhab): array
    {
        // General offline estimation fallback based on average daylight patterns
        $dayOfYear = date('z', strtotime($date));
        
        // simple solar declination formula
        $declination = 23.45 * sin(deg2rad((360 / 365) * ($dayOfYear - 80)));
        
        // Approximate solar noon in local standard time (assuming standard time zones)
        // Standard timezone offset can be approximated by longitude / 15
        $timezoneOffset = round($longitude / 15);
        $solarNoon = 12.0 - ($longitude / 15.0 - $timezoneOffset) - (7.67 * sin(deg2rad(2 * ($dayOfYear - 81))) - 9.87 * sin(deg2rad(4 * ($dayOfYear - 81)))) / 60.0;
        
        // Hour angle for sunrise/sunset (90.83 degrees for sun's upper limb)
        $cosHourAngle = (cos(deg2rad(90.833)) - sin(deg2rad($latitude)) * sin(deg2rad($declination))) / (cos(deg2rad($latitude)) * cos(deg2rad($declination)));
        
        if ($cosHourAngle < -1) $cosHourAngle = -1;
        if ($cosHourAngle > 1) $cosHourAngle = 1;
        
        $hourAngle = rad2deg(acos($cosHourAngle));
        $dayLength = ($hourAngle / 15.0) * 2;
        
        $sunriseDecimal = $solarNoon - ($dayLength / 2);
        $sunsetDecimal = $solarNoon + ($dayLength / 2);
        
        // Fajr (sun 18 degrees below horizon)
        $cosFajr = (cos(deg2rad(90 + 18)) - sin(deg2rad($latitude)) * sin(deg2rad($declination))) / (cos(deg2rad($latitude)) * cos(deg2rad($declination)));
        $cosFajr = max(-1, min(1, $cosFajr));
        $fajrAngle = rad2deg(acos($cosFajr));
        $fajrDecimal = $solarNoon - ($fajrAngle / 15.0);

        // Isha (sun 18 degrees below horizon)
        $ishaDecimal = $solarNoon + ($fajrAngle / 15.0);
        
        // Asr calculation (Shafi: shadow ratio = 1, Hanafi: shadow ratio = 2)
        $shadowRatio = (strtolower($madhab) === 'hanafi') ? 2 : 1;
        $latitudeDifference = abs($latitude - $declination);
        $cosAsr = (sin(atan(1 / ($shadowRatio + tan(deg2rad($latitudeDifference))))) - sin(deg2rad($latitude)) * sin(deg2rad($declination))) / (cos(deg2rad($latitude)) * cos(deg2rad($declination)));
        $cosAsr = max(-1, min(1, $cosAsr));
        $asrAngle = rad2deg(acos($cosAsr));
        $asrDecimal = $solarNoon + ($asrAngle / 15.0);
        
        return [
            'fajr' => $this->formatDecimalTime($fajrDecimal),
            'dhuhr' => $this->formatDecimalTime($solarNoon),
            'asr' => $this->formatDecimalTime($asrDecimal),
            'maghrib' => $this->formatDecimalTime($sunsetDecimal),
            'isha' => $this->formatDecimalTime($ishaDecimal),
            'sunrise' => $this->formatDecimalTime($sunriseDecimal),
            'sunset' => $this->formatDecimalTime($sunsetDecimal),
            'source' => 'Offline Estimate (Fallback)',
        ];
    }

    /**
     * Helper to convert decimal hours to HH:MM format.
     */
    private function formatDecimalTime(float $decimalHours): string
    {
        $decimalHours = ($decimalHours + 24) % 24; // Ensure 0-24
        $hours = floor($decimalHours);
        $minutes = round(($decimalHours - $hours) * 60);
        
        if ($minutes === 60) {
            $hours = ($hours + 1) % 24;
            $minutes = 0;
        }
        
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
