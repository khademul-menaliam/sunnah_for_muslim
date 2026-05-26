<?php

namespace App\Http\Controllers;

use App\Models\SunnahLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SunnahLogController extends Controller
{
    /**
     * Store or toggle a sunnah checklist item completion.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'sunnah_id' => 'required|exists:sunnahs,id',
            'date' => 'required|date',
            'completed' => 'required|boolean',
            'notes' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        if (! $user) {
            // Guest session tracking support
            $date = $request->input('date');
            $sunnahId = (int) $request->input('sunnah_id');
            $completed = $request->input('completed');

            $sessionKey = "sunnah_logs.{$date}";
            $logs = session()->get($sessionKey, []);

            if ($completed) {
                if (! in_array($sunnahId, $logs)) {
                    $logs[] = $sunnahId;
                }
            } else {
                $logs = array_filter($logs, fn ($id) => $id != $sunnahId);
            }

            session()->put($sessionKey, array_values($logs));

            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'status' => 'success',
                    'log' => [
                        'sunnah_id' => $sunnahId,
                        'completed' => $completed,
                    ],
                ]);
            }

            return redirect()->back()->with('success', 'Sunnah tracked in guest session successfully.');
        }

        $log = SunnahLog::updateOrCreate(
            [
                'user_id' => $user->id,
                'sunnah_id' => $request->input('sunnah_id'),
                'date' => $request->input('date'),
            ],
            [
                'completed' => $request->input('completed'),
                'notes' => $request->input('notes'),
            ]
        );

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'log' => $log,
            ]);
        }

        return redirect()->back()->with('success', 'Sunnah log updated successfully.');
    }
}
