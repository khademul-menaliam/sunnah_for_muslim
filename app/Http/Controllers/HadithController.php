<?php

namespace App\Http\Controllers;

use App\Models\Hadith;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HadithController extends Controller
{
    /**
     * Display a listing of Hadiths, filterable by module, topic, or prayer.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = Hadith::query();

        if ($request->filled('module')) {
            $query->where('module', $request->input('module'));
        }

        if ($request->filled('topic')) {
            $query->where('topic', 'like', '%' . $request->input('topic') . '%');
        }

        if ($request->filled('prayer_id')) {
            $query->where('prayer_id', $request->input('prayer_id'));
        }

        $hadiths = $query->orderBy('id', 'asc')->paginate(15);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($hadiths);
        }

        return view('hadiths.index', compact('hadiths'));
    }

    /**
     * Display the specified Hadith in detail.
     */
    public function show($id, Request $request): View|JsonResponse
    {
        $hadith = Hadith::with('prayer')->findOrFail($id);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'hadith' => $hadith,
            ]);
        }

        return view('hadiths.show', compact('hadith'));
    }

    /**
     * Get all Hadiths associated with a specific prayer.
     */
    public function byPrayer($prayerId, Request $request): View|JsonResponse
    {
        $hadiths = Hadith::where('prayer_id', $prayerId)->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'prayer_id' => $prayerId,
                'hadiths' => $hadiths,
            ]);
        }

        return view('hadiths.index', [
            'hadiths' => $hadiths,
            'title' => 'Hadiths related to Prayer ID: ' . $prayerId,
        ]);
    }

    /**
     * Get all Hadiths associated with a specific module.
     */
    public function byModule($module, Request $request): View|JsonResponse
    {
        $hadiths = Hadith::where('module', $module)->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'module' => $module,
                'hadiths' => $hadiths,
            ]);
        }

        return view('hadiths.index', [
            'hadiths' => $hadiths,
            'title' => 'Hadiths related to ' . ucfirst($module) . ' habits',
        ]);
    }
}
