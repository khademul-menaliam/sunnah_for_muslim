<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
use App\Models\PrayerLog;
use App\Models\SpecialPrayer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PrayerController extends Controller
{
    /**
     * Display the list of five daily prayers.
     */
    public function index(Request $request): View|JsonResponse
    {
        $prayers = Prayer::with('hadiths')->orderBy('order_number', 'asc')->get();
        $specialPrayers = SpecialPrayer::with('hadith')->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'prayers' => $prayers,
                'special_prayers' => $specialPrayers,
            ]);
        }

        return view('prayers.index', compact('prayers', 'specialPrayers'));
    }

    /**
     * Display a single prayer with its rakat breakdown and linked hadiths.
     */
    public function show($id, Request $request): View|JsonResponse
    {
        $prayer = Prayer::with(['hadiths' => function($q) {
            $q->where('verified', true);
        }])->findOrFail($id);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'prayer' => $prayer,
            ]);
        }

        return view('prayers.show', compact('prayer'));
    }

    /**
     * Display the daily prayer tracker and calculate prayer streaks.
     */
    public function tracker(Request $request): View
    {
        $user = Auth::user();
        $date = $request->input('date', date('Y-m-d'));
        
        $prayers = Prayer::orderBy('order_number', 'asc')->get();

        // Get logs for selected date
        $logs = [];
        if ($user) {
            $logs = PrayerLog::where('user_id', $user->id)
                ->where('date', $date)
                ->get()
                ->keyBy('prayer_id');
        }

        // Calculate Streak (consecutive days where all 5 prayers are marked prayed/congregation)
        $streak = 0;
        if ($user) {
            $streak = $this->calculateStreak($user->id);
        }

        return view('prayers.tracker', compact('prayers', 'logs', 'date', 'streak'));
    }

    /**
     * Helper to calculate consecutive days of all 5 prayers logged as prayed or congregation.
     */
    private function calculateStreak(int $userId): int
    {
        $streak = 0;
        $checkDate = date('Y-m-d');
        
        // Loop backwards starting today
        for ($i = 0; $i < 365; $i++) {
            $dateStr = date('Y-m-d', strtotime("-$i days"));
            
            // Check if user has logged all 5 prayers on this day
            $dailyLogs = PrayerLog::where('user_id', $userId)
                ->where('date', $dateStr)
                ->whereIn('status', ['prayed', 'congregation'])
                ->count();

            if ($dailyLogs === 5) {
                $streak++;
            } else {
                // If it's today and they haven't prayed all 5 yet, don't break the streak immediately
                if ($i === 0) {
                    continue;
                }
                break;
            }
        }

        return $streak;
    }
}
