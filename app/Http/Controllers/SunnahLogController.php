<?php

namespace App\Http\Controllers;

use App\Models\SunnahLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SunnahLogController extends Controller
{
    /**
     * Store or toggle a sunnah checklist item completion.
     */
    public function store(Request $request): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'sunnah_id' => 'required|exists:sunnahs,id',
            'date' => 'required|date',
            'completed' => 'required|boolean',
            'notes' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        if (!$user) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to track your daily habits.');
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
