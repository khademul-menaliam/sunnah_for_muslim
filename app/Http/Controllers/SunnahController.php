<?php

namespace App\Http\Controllers;

use App\Models\Sunnah;
use App\Models\SunnahLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SunnahController extends Controller
{
    /**
     * Display the Sunnah practices dashboard, checklist, and weekly charts.
     */
    public function index(Request $request): View|JsonResponse
    {
        $user = Auth::user();
        $date = $request->input('date', date('Y-m-d'));
        $category = $request->input('category');
        $difficulty = $request->input('difficulty'); // easy, medium, advanced

        $query = Sunnah::with('hadith');

        // Apply difficulty filters (Beginner mode shows only 'easy' sunnahs)
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $difficulty);
        }

        if ($request->filled('category')) {
            $query->where('category', $category);
        }

        $sunnahs = $query->orderBy('order_number', 'asc')->get();

        // Get completion logs for the selected date
        $logs = [];
        if ($user) {
            $logs = SunnahLog::where('user_id', $user->id)
                ->where('date', $date)
                ->where('completed', true)
                ->pluck('sunnah_id')
                ->toArray();
        }

        // Calculate Weekly Completion Chart data (last 7 days percentages)
        $weeklyProgress = [];
        if ($user) {
            $totalSunnahsCount = Sunnah::count();
            for ($i = 6; $i >= 0; $i--) {
                $checkDate = date('Y-m-d', strtotime("-$i days"));
                $completedCount = SunnahLog::where('user_id', $user->id)
                    ->where('date', $checkDate)
                    ->where('completed', true)
                    ->count();

                $percent = $totalSunnahsCount > 0 ? round(($completedCount / $totalSunnahsCount) * 100) : 0;
                $weeklyProgress[] = [
                    'day' => date('D', strtotime($checkDate)),
                    'date' => $checkDate,
                    'percentage' => $percent,
                    'completed' => $completedCount,
                ];
            }
        }

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'date' => $date,
                'sunnahs' => $sunnahs,
                'completed_ids' => $logs,
                'weekly_progress' => $weeklyProgress,
            ]);
        }

        return view('sunnahs.index', compact('sunnahs', 'logs', 'date', 'difficulty', 'category', 'weeklyProgress'));
    }
}
