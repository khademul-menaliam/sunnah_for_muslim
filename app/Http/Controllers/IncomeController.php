<?php

namespace App\Http\Controllers;

use App\Models\IncomeType;
use App\Models\BusinessEthic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IncomeController extends Controller
{
    /**
     * Display the Job and Halal Rizq search center.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = IncomeType::with('hadith');

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('industry', 'like', '%' . $searchTerm . '%')
                  ->orWhere('explanation', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $jobs = $query->orderBy('category', 'asc')->get();
        $ethics = BusinessEthic::with('hadith')->orderBy('category', 'asc')->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'jobs' => $jobs,
                'ethics' => $ethics,
            ]);
        }

        return view('income.index', compact('jobs', 'ethics'));
    }
}
