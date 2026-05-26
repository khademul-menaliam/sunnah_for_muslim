<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'name',
    'arabic_name',
    'description',
    'example',
    'hadith_id',
])]
class IslamicFinanceConcept extends Model
{
    /**
     * Get the Hadith linked to this finance concept.
     *
     * @return BelongsTo<Hadith, $this>
     */
    public function hadith(): BelongsTo
    {
        return $this->belongsTo(Hadith::class);
    }
}
