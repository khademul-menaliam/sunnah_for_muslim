<?php

namespace App\Http\Controllers;

use App\Models\IslamicFinanceConcept;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinanceController extends Controller
{
    /**
     * Display a glossary of Islamic Finance concepts.
     */
    public function index(Request $request): View|JsonResponse
    {
        $concepts = IslamicFinanceConcept::with('hadith')
            ->orderBy('id', 'asc')
            ->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'concepts' => $concepts,
            ]);
        }

        return view('income.finance', compact('concepts'));
    }
}
