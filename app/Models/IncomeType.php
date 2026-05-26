<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'title',
    'category',
    'industry',
    'explanation',
    'quran_reference',
    'hadith_id',
])]
class IncomeType extends Model
{
    /**
     * Get the Hadith linked to this income type.
     *
     * @return BelongsTo<Hadith, $this>
     */
    public function hadith(): BelongsTo
    {
        return $this->belongsTo(Hadith::class);
    }
}
