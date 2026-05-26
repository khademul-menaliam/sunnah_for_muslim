<?php

namespace App\Http\Controllers;

use App\Models\EatingEtiquette;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EtiquetteController extends Controller
{
    /**
     * Display the 21 sunnahs and etiquettes of eating.
     */
    public function index(Request $request): View|JsonResponse
    {
        $etiquettes = EatingEtiquette::with('hadith')
            ->orderBy('order_number', 'asc')
            ->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'etiquettes' => $etiquettes,
            ]);
        }

        return view('eating.etiquettes', compact('etiquettes'));
    }
}
