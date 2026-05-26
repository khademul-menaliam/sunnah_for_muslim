<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\EatingEtiquette;
use App\Models\DuaForEating;
use App\Models\FastingSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EatingController extends Controller
{
    /**
     * Display the eating habits hub dashboard.
     */
    public function index(Request $request): View|JsonResponse
    {
        $foods = Food::whereIn('name', ['Ajwa Dates', 'Pure Natural Honey', 'Extra Virgin Olive Oil', 'Sweet Pomegranate', 'Fresh Figs', 'Black Seed (Habbat al-Barakah)'])->get();
        $etiquettes = EatingEtiquette::orderBy('order_number', 'asc')->take(5)->get();
        $duas = DuaForEating::take(3)->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'blessed_foods' => $foods,
                'featured_etiquettes' => $etiquettes,
                'featured_duas' => $duas,
            ]);
        }

        return view('eating.index', compact('foods', 'etiquettes', 'duas'));
    }
}
