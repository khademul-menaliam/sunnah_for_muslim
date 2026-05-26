<?php

namespace App\Http\Controllers;

use App\Models\Hadith;
use App\Models\PrayerLog;
use App\Models\PrayerTimesCache;
use App\Models\Sunnah;
use App\Models\SunnahLog;
use App\Services\IslamicCalculations;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected IslamicCalculations $calculations
    ) {}

    /**
     * Display today's dashboard.
     */
    public function index(Request $request): View|JsonResponse
    {
        $user = Auth::user();
        $date = date('Y-m-d');

        // 1. Get today's prayer times
        $latitude = $user->latitude ?? 23.8103;
        $longitude = $user->longitude ?? 90.4125;
        $method = $user->prayer_calculation_method ?? 'Karachi';
        $madhab = $user->madhab ?? 'Hanafi';

        $cached = null;
        if ($user) {
            $cached = PrayerTimesCache::where('user_id', $user->id)
                ->where('date', $date)
                ->first();
        }

        if ($cached) {
            $timings = [
                'Fajr' => $cached->fajr_time,
                'Dhuhr' => $cached->dhuhr_time,
                'Asr' => $cached->asr_time,
                'Maghrib' => $cached->maghrib_time,
                'Isha' => $cached->isha_time,
            ];
        } else {
            $raw = $this->calculations->getPrayerTimes($latitude, $longitude, $date, $method, $madhab);
            $timings = [
                'Fajr' => $raw['fajr'],
                'Dhuhr' => $raw['dhuhr'],
                'Asr' => $raw['asr'],
                'Maghrib' => $raw['maghrib'],
                'Isha' => $raw['isha'],
            ];

            if ($user) {
                PrayerTimesCache::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'date' => $date,
                    ],
                    [
                        'location' => ($user->city ?? 'Dhaka').', '.($user->country ?? 'Bangladesh'),
                        'fajr_time' => $raw['fajr'],
                        'dhuhr_time' => $raw['dhuhr'],
                        'asr_time' => $raw['asr'],
                        'maghrib_time' => $raw['maghrib'],
                        'isha_time' => $raw['isha'],
                        'calculation_method' => $method,
                    ]
                );
            }
        }

        // 2. Determine Next Prayer & Countdown
        $currentTime = date('H:i');
        $nextPrayerName = 'Fajr';
        $nextPrayerTime = $timings['Fajr'];

        foreach ($timings as $name => $time) {
            if ($currentTime < $time) {
                $nextPrayerName = $name;
                $nextPrayerTime = $time;
                break;
            }
        }

        // 3. Get today's prayer logs
        $prayerLogs = [];
        if ($user) {
            $prayerLogs = PrayerLog::where('user_id', $user->id)
                ->where('date', $date)
                ->pluck('status', 'prayer_id')
                ->toArray();
        } else {
            // Guest session tracking support
            $sessionLogs = session()->get("prayer_logs.{$date}", []);
            foreach ($sessionLogs as $pId => $log) {
                $prayerLogs[(int) $pId] = $log['status'] ?? 'unlogged';
            }
        }

        // 4. Get today's Sunnah progress
        $totalSunnahs = Sunnah::count();
        $completedSunnahs = 0;
        $sunnahProgress = 0;

        if ($user && $totalSunnahs > 0) {
            $completedSunnahs = SunnahLog::where('user_id', $user->id)
                ->where('date', $date)
                ->where('completed', true)
                ->count();
            $sunnahProgress = round(($completedSunnahs / $totalSunnahs) * 100);
        } elseif ($totalSunnahs > 0) {
            // Guest session tracking support
            $completedSunnahs = count(session()->get("sunnah_logs.{$date}", []));
            $sunnahProgress = round(($completedSunnahs / $totalSunnahs) * 100);
        }

        // 5. Random Hadith of the Day (seeded hadiths)
        $dayOfYear = (int) date('z');
        $hadithCount = Hadith::count();
        $hadithOfDay = null;
        if ($hadithCount > 0) {
            $hadithId = ($dayOfYear % $hadithCount) + 1;
            $hadithOfDay = Hadith::find($hadithId) ?? Hadith::inRandomOrder()->first();
        }

        $dashboardData = [
            'timings' => $timings,
            'next_prayer' => [
                'name' => $nextPrayerName,
                'time' => $nextPrayerTime,
            ],
            'prayer_logs' => $prayerLogs,
            'sunnah' => [
                'total' => $totalSunnahs,
                'completed' => $completedSunnahs,
                'percentage' => $sunnahProgress,
            ],
            'hadith_of_day' => $hadithOfDay,
        ];

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'data' => $dashboardData,
            ]);
        }

        return view('dashboard', compact('timings', 'nextPrayerName', 'nextPrayerTime', 'prayerLogs', 'totalSunnahs', 'completedSunnahs', 'sunnahProgress', 'hadithOfDay'));
    }
}
