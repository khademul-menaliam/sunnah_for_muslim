<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'title',
    'arabic_title',
    'description',
    'category',
    'difficulty',
    'is_daily',
    'time_of_day',
    'hadith_id',
    'order_number',
])]
class Sunnah extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_daily' => 'boolean',
        ];
    }

    /**
     * Get the Hadith linked to this sunnah.
     *
     * @return BelongsTo<Hadith, $this>
     */
    public function hadith(): BelongsTo
    {
        return $this->belongsTo(Hadith::class);
    }

    /**
     * Get the logs associated with the sunnah.
     *
     * @return HasMany<SunnahLog, $this>
     */
    public function logs(): HasMany
    {
        return $this->hasMany(SunnahLog::class);
    }
}
