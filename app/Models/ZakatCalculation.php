<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'year',
    'cash_savings',
    'gold_value',
    'silver_value',
    'business_assets',
    'receivables',
    'liabilities',
    'nisab_threshold',
    'net_zakatable_assets',
    'zakat_due',
    'notes',
])]
class ZakatCalculation extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cash_savings' => 'float',
            'gold_value' => 'float',
            'silver_value' => 'float',
            'business_assets' => 'float',
            'receivables' => 'float',
            'liabilities' => 'float',
            'nisab_threshold' => 'float',
            'net_zakatable_assets' => 'float',
            'zakat_due' => 'float',
        ];
    }

    /**
     * Get the user that owns the zakat calculation.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
