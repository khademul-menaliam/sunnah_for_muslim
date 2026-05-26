<?php

namespace App\Http\Controllers;

use App\Models\PrayerTimesCache;
use App\Services\IslamicCalculations;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PrayerTimeController extends Controller
{
    public function __construct(
        protected IslamicCalculations $calculations
    ) {}

    /**
     * Display today's prayer times for the user.
     */
    public function index(Request $request): View|JsonResponse
    {
        $user = Auth::user();
        $date = $request->input('date', date('Y-m-d'));

        // Default location settings if user profile has none
        $city = $request->input('city', $user->city ?? 'Dhaka');
        $country = $request->input('country', $user->country ?? 'Bangladesh');
        $latitude = (float) $request->input('lat', $user->latitude ?? 23.8103);
        $longitude = (float) $request->input('lng', $user->longitude ?? 90.4125);
        $method = $request->input('method', $user->prayer_calculation_method ?? 'Karachi');
        $madhab = $request->input('madhab', $user->madhab ?? 'Hanafi');

        // Check if cached values exist
        $cached = null;
        if ($user) {
            $cached = PrayerTimesCache::where('user_id', $user->id)
                ->where('date', $date)
                ->first();
        }

        if ($cached) {
            $timings = [
                'fajr' => $cached->fajr_time,
                'dhuhr' => $cached->dhuhr_time,
                'asr' => $cached->asr_time,
                'maghrib' => $cached->maghrib_time,
                'isha' => $cached->isha_time,
                'sunrise' => '05:30', // Approximate default/cached
                'sunset' => '18:40',
                'source' => 'Database Cache',
            ];
        } else {
            // Fetch fresh timings
            $timings = $this->calculations->getPrayerTimes($latitude, $longitude, $date, $method, $madhab);

            // Save in cache if user is authenticated
            if ($user) {
                PrayerTimesCache::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'date' => $date,
                    ],
                    [
                        'location' => "{$city}, {$country}",
                        'fajr_time' => $timings['fajr'],
                        'dhuhr_time' => $timings['dhuhr'],
                        'asr_time' => $timings['asr'],
                        'maghrib_time' => $timings['maghrib'],
                        'isha_time' => $timings['isha'],
                        'calculation_method' => $method,
                    ]
                );
            }
        }

        $locationInfo = [
            'city' => $city,
            'country' => $country,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'method' => $method,
            'madhab' => $madhab,
        ];

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'date' => $date,
                'location' => $locationInfo,
                'timings' => $timings,
            ]);
        }

        return view('prayers.times', compact('timings', 'locationInfo', 'date'));
    }

    /**
     * API specific prayer times fetch.
     */
    public function apiGetTimes(Request $request): JsonResponse
    {
        $date = $request->input('date', date('Y-m-d'));
        $latitude = (float) $request->input('lat', 23.8103);
        $longitude = (float) $request->input('lng', 90.4125);
        $method = $request->input('method', 'Karachi');
        $madhab = $request->input('madhab', 'Hanafi');

        $timings = $this->calculations->getPrayerTimes($latitude, $longitude, $date, $method, $madhab);

        return response()->json([
            'status' => 'success',
            'date' => $date,
            'location' => [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'method' => $method,
                'madhab' => $madhab,
            ],
            'timings' => $timings,
        ]);
    }
}
