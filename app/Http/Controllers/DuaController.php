<?php

namespace App\Http\Controllers;

use App\Models\DuaForEating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DuaController extends Controller
{
    /**
     * Display the duas related to eating and fasting.
     */
    public function eating(Request $request): View|JsonResponse
    {
        $duas = DuaForEating::with('hadith')->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'duas' => $duas,
            ]);
        }

        return view('eating.duas', compact('duas'));
    }
}
