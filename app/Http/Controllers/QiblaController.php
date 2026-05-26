<?php

namespace App\Http\Controllers;

use App\Services\IslamicCalculations;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QiblaController extends Controller
{
    public function __construct(
        protected IslamicCalculations $calculations
    ) {}

    /**
     * Display the Qibla compass view.
     */
    public function index(Request $request): View|JsonResponse
    {
        $user = Auth::user();
        
        $latitude = $request->input('lat', $user->latitude ?? 23.8103);
        $longitude = $request->input('lng', $user->longitude ?? 90.4125);
        $city = $user->city ?? 'Your Current Location';

        $qiblaDegree = $this->calculations->calculateQibla((float) $latitude, (float) $longitude);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'location' => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ],
                'qibla_bearing' => $qiblaDegree,
            ]);
        }

        return view('prayers.qibla', compact('qiblaDegree', 'latitude', 'longitude', 'city'));
    }
}
