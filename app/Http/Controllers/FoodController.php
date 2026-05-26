<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FoodController extends Controller
{
    /**
     * Display a listing of foods, filterable by search term and status.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = Food::with('hadith');

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('arabic_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $searchTerm . '%')
                  ->orWhere('reason', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $foods = $query->orderBy('status', 'asc')->get();

        // Separate categories for views
        $blessedFoods = $foods->filter(fn($f) => in_array($f->name, ['Ajwa Dates', 'Pure Natural Honey', 'Extra Virgin Olive Oil', 'Sweet Pomegranate', 'Fresh Figs', 'Black Seed (Habbat al-Barakah)']));
        $haramFoods = $foods->filter(fn($f) => $f->status === 'haram');
        $allFoods = $foods;

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'foods' => $allFoods,
            ]);
        }

        return view('eating.foods', compact('allFoods', 'blessedFoods', 'haramFoods'));
    }
}
