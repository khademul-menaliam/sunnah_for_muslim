<?php

namespace App\Http\Controllers;

use App\Models\Adhkar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdhkarController extends Controller
{
    /**
     * Display the Adhkar (Dhikr) library, grouped by category.
     */
    public function index(Request $request): View|JsonResponse
    {
        $category = $request->input('category');
        
        $query = Adhkar::query();
        if ($request->filled('category')) {
            $query->where('category', $category);
        }

        $adhkars = $query->get()->groupBy('category');

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'adhkars' => $adhkars,
            ]);
        }

        return view('adhkar.index', compact('adhkars', 'category'));
    }
}
