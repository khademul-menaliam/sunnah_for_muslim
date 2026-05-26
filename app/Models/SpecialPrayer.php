<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'name',
    'arabic_name',
    'category',
    'rakat',
    'description',
    'hadith_id',
    'time_guide',
])]
class SpecialPrayer extends Model
{
    /**
     * Get the Hadith linked to this special prayer.
     *
     * @return BelongsTo<Hadith, $this>
     */
    public function hadith(): BelongsTo
    {
        return $this->belongsTo(Hadith::class);
    }
}
