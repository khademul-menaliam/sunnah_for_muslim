<?php

namespace App\Http\Controllers;

use App\Models\ZakatCalculation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ZakatController extends Controller
{
    /**
     * Display the Zakat calculator page and historical calculations.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $history = [];
        
        if ($user) {
            $history = ZakatCalculation::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('income.zakat', compact('history'));
    }

    /**
     * Perform the Zakat calculation.
     */
    public function calculate(Request $request): View|JsonResponse
    {
        $request->validate([
            'cash_savings' => 'required|numeric|min:0',
            'gold_weight' => 'required|numeric|min:0',
            'gold_price' => 'required|numeric|min:0',
            'silver_weight' => 'required|numeric|min:0',
            'silver_price' => 'required|numeric|min:0',
            'business_assets' => 'required|numeric|min:0',
            'receivables' => 'required|numeric|min:0',
            'liabilities' => 'required|numeric|min:0',
            'nisab_basis' => 'required|in:gold,silver',
            'notes' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        
        $cash = (float) $request->input('cash_savings');
        $goldWeight = (float) $request->input('gold_weight');
        $goldPrice = (float) $request->input('gold_price');
        $silverWeight = (float) $request->input('silver_weight');
        $silverPrice = (float) $request->input('silver_price');
        $businessAssets = (float) $request->input('business_assets');
        $receivables = (float) $request->input('receivables');
        $liabilities = (float) $request->input('liabilities');
        $nisabBasis = $request->input('nisab_basis');

        // Gold Nisab = 87.48g, Silver Nisab = 612.36g
        $goldValue = $goldWeight * $goldPrice;
        $silverValue = $silverWeight * $silverPrice;

        $nisabThreshold = $nisabBasis === 'gold' 
            ? 87.48 * $goldPrice 
            : 612.36 * $silverPrice;

        $totalAssets = $cash + $goldValue + $silverValue + $businessAssets + $receivables;
        $netZakatable = $totalAssets - $liabilities;

        $zakatDue = 0.0;
        $eligibleForZakat = false;

        if ($netZakatable >= $nisabThreshold) {
            $zakatDue = $netZakatable * 0.025; // 2.5%
            $eligibleForZakat = true;
        }

        // Save calculation if user is authenticated
        $calculation = null;
        if ($user) {
            $calculation = ZakatCalculation::create([
                'user_id' => $user->id,
                'year' => (int) date('Y'),
                'cash_savings' => $cash,
                'gold_value' => $goldValue,
                'silver_value' => $silverValue,
                'business_assets' => $businessAssets,
                'receivables' => $receivables,
                'liabilities' => $liabilities,
                'nisab_threshold' => $nisabThreshold,
                'net_zakatable_assets' => $netZakatable,
                'zakat_due' => $zakatDue,
                'notes' => $request->input('notes'),
            ]);
        }

        // 8 Recipient categories defined in Surah At-Tawbah 9:60
        $recipientCategories = [
            [
                'arabic' => 'الفقراء',
                'name' => 'Al-Fuqara (The Poor)',
                'description' => 'Those who do not have any property or livelihood to support their basic needs.',
            ],
            [
                'arabic' => 'المساكين',
                'name' => 'Al-Masakin (The Needy)',
                'description' => 'Those who have some income but it is insufficient to cover their core expenses.',
            ],
            [
                'arabic' => 'العاملين عليها',
                'name' => 'Al-Amilina \'Alayha (Zakat Collectors)',
                'description' => 'Those authorized to collect, manage, and distribute the Zakat funds.',
            ],
            [
                'arabic' => 'المؤلفة قلوبهم',
                'name' => 'Al-Mu\'allafati Qulubuhum (New Muslims/Allies)',
                'description' => 'Those whose hearts are to be reconciled or inclined towards Islam.',
            ],
            [
                'arabic' => 'في الرقاب',
                'name' => 'Fir-Riqab (Captives/Slaves)',
                'description' => 'To aid in liberating captives, slaves, or victims of human trafficking.',
            ],
            [
                'arabic' => 'الغارمين',
                'name' => 'Al-Gharimin (Debtors)',
                'description' => 'Those overwhelmed by debt incurred for basic needs or community reconciliation.',
            ],
            [
                'arabic' => 'في سبيل الله',
                'name' => 'Fi Sabilillah (In the Cause of Allah)',
                'description' => 'Those striving in the path of Allah for community welfare, education, and defense.',
            ],
            [
                'arabic' => 'ابن السبيل',
                'name' => 'Ibnus-Sabil (The Wayfarer)',
                'description' => 'Stranded travelers who do not have enough funds to reach their home safely.',
            ],
        ];

        $results = [
            'cash' => $cash,
            'gold_value' => $goldValue,
            'silver_value' => $silverValue,
            'business_assets' => $businessAssets,
            'receivables' => $receivables,
            'liabilities' => $liabilities,
            'total_assets' => $totalAssets,
            'net_zakatable' => $netZakatable,
            'nisab_basis' => $nisabBasis,
            'nisab_threshold' => $nisabThreshold,
            'zakat_due' => $zakatDue,
            'eligible' => $eligibleForZakat,
            'recipients' => $recipientCategories,
        ];

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'calculation' => $results,
            ]);
        }

        $history = $user ? ZakatCalculation::where('user_id', $user->id)->orderBy('created_at', 'desc')->get() : [];

        return view('income.zakat', compact('results', 'history'));
    }
}
