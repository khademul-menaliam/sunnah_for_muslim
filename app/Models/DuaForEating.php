<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'occasion',
    'arabic_text',
    'transliteration',
    'translation',
    'hadith_id',
])]
class DuaForEating extends Model
{
    /**
     * Get the Hadith linked to this dua.
     *
     * @return BelongsTo<Hadith, $this>
     */
    public function hadith(): BelongsTo
    {
        return $this->belongsTo(Hadith::class);
    }
}
