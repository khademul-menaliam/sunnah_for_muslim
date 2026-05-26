<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'name',
    'arabic_name',
    'status',
    'category',
    'reason',
    'quran_reference',
    'hadith_id',
])]
class Food extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'foods';

    /**
     * Get the Hadith linked to this food.
     *
     * @return BelongsTo<Hadith, $this>
     */
    public function hadith(): BelongsTo
    {
        return $this->belongsTo(Hadith::class);
    }
}
