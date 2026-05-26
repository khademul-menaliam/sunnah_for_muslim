<?php

namespace App\Http\Controllers;

use App\Models\PrayerLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrayerLogController extends Controller
{
    /**
     * Store or update a prayer log.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'prayer_id' => 'required|exists:prayers,id',
            'date' => 'required|date',
            'status' => 'required|in:prayed,missed,qada,congregation',
            'notes' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        if (! $user) {
            // Guest session tracking support
            $date = $request->input('date');
            $prayerId = (int) $request->input('prayer_id');
            $status = $request->input('status');
            $notes = $request->input('notes');

            $sessionKey = "prayer_logs.{$date}.{$prayerId}";
            session()->put($sessionKey, [
                'prayer_id' => $prayerId,
                'status' => $status,
                'notes' => $notes,
            ]);

            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'status' => 'success',
                    'log' => [
                        'prayer_id' => $prayerId,
                        'status' => $status,
                        'notes' => $notes,
                    ],
                ]);
            }

            return redirect()->back()->with('success', 'Prayer tracked in guest session successfully.');
        }

        $log = PrayerLog::updateOrCreate(
            [
                'user_id' => $user->id,
                'prayer_id' => $request->input('prayer_id'),
                'date' => $request->input('date'),
            ],
            [
                'status' => $request->input('status'),
                'prayed_at' => $request->input('status') === 'prayed' || $request->input('status') === 'congregation' ? now() : null,
                'notes' => $request->input('notes'),
            ]
        );

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'log' => $log,
            ]);
        }

        return redirect()->back()->with('success', 'Prayer log updated successfully.');
    }
}
