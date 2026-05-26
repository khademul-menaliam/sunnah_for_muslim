<?php

use App\Http\Controllers\AdhkarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DuaController;
use App\Http\Controllers\EatingController;
use App\Http\Controllers\EtiquetteController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\PrayerLogController;
use App\Http\Controllers\PrayerTimeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QiblaController;
use App\Http\Controllers\SunnahController;
use App\Http\Controllers\SunnahLogController;
use App\Http\Controllers\ZakatController;
use Illuminate\Support\Facades\Route;

// Redirect home directly to the public interactive cockpit dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// ==========================================
// 🌟 PUBLIC PORTAL ROUTES (NO LOGIN REQUIRED)
// ==========================================

// Central Cockpit Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// MODULE 1 - DAILY PRAYERS
Route::get('/prayers', [PrayerController::class, 'index'])->name('prayers.index');
Route::get('/prayers/{prayer}', [PrayerController::class, 'show'])->name('prayers.show');
Route::get('/prayer-tracker', [PrayerController::class, 'tracker'])->name('prayers.tracker');
Route::post('/prayer-logs', [PrayerLogController::class, 'store'])->name('prayer-logs.store');
Route::get('/prayer-times', [PrayerTimeController::class, 'index'])->name('prayer-times.index');
Route::get('/qibla', [QiblaController::class, 'index'])->name('qibla.index');

// MODULE 2 - EATING HABITS (HALAL & TAYYIB)
Route::get('/eating', [EatingController::class, 'index'])->name('eating.index');
Route::get('/eating/foods', [FoodController::class, 'index'])->name('eating.foods');
Route::get('/eating/etiquettes', [EtiquetteController::class, 'index'])->name('eating.etiquettes');
Route::get('/eating/duas', [DuaController::class, 'eating'])->name('eating.duas');

// MODULE 3 - SUNNAH PRACTICES
Route::get('/sunnahs', [SunnahController::class, 'index'])->name('sunnahs.index');
Route::post('/sunnah-logs', [SunnahLogController::class, 'store'])->name('sunnah-logs.store');
Route::get('/adhkar', [AdhkarController::class, 'index'])->name('adhkar.index');

// MODULE 4 - JOB & INCOME
Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
Route::get('/income/finance-concepts', [FinanceController::class, 'index'])->name('income.finance');
Route::get('/income/zakat', [ZakatController::class, 'index'])->name('income.zakat');
Route::post('/income/zakat/calculate', [ZakatController::class, 'calculate'])->name('income.zakat.calculate');

// VERIFIED SCRIPTURES
Route::get('/hadiths', [HadithController::class, 'index'])->name('hadiths.index');
Route::get('/hadiths/{hadith}', [HadithController::class, 'show'])->name('hadiths.show');

// ==========================================
// 🔒 ADMIN BACKEND ROUTES (AUTH REQUIRED)
// ==========================================
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // Admin Hadith database management
    Route::get('/hadiths/create', [HadithController::class, 'create'])->name('admin.hadiths.create');
    Route::post('/hadiths', [HadithController::class, 'store'])->name('admin.hadiths.store');
    Route::get('/hadiths/{hadith}/edit', [HadithController::class, 'edit'])->name('admin.hadiths.edit');
    Route::put('/hadiths/{hadith}', [HadithController::class, 'update'])->name('admin.hadiths.update');
    Route::delete('/hadiths/{hadith}', [HadithController::class, 'destroy'])->name('admin.hadiths.destroy');

    // Admin Profile administration
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// API v1 Routes (prefixed with /api/v1)
Route::prefix('api/v1')->group(function () {
    Route::get('/prayers', [PrayerController::class, 'index']);
    Route::get('/prayers/{id}/hadiths', [HadithController::class, 'byPrayer']);
    Route::get('/prayer-times', [PrayerTimeController::class, 'apiGetTimes']);
    Route::get('/sunnahs', [SunnahController::class, 'index']);
    Route::get('/hadiths', [HadithController::class, 'index']);
    Route::get('/foods', [FoodController::class, 'index']);
    Route::post('/zakat/calculate', [ZakatController::class, 'calculate']);
    Route::get('/qibla', [QiblaController::class, 'index']);
});

require __DIR__.'/auth.php';
