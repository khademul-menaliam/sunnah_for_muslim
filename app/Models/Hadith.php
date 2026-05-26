<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'prayer_id',
    'module',
    'arabic_text',
    'transliteration',
    'translation',
    'source',
    'narrator',
    'topic',
    'verified',
])]
class Hadith extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'verified' => 'boolean',
        ];
    }

    /**
     * Get the prayer associated with the Hadith.
     *
     * @return BelongsTo<Prayer, $this>
     */
    public function prayer(): BelongsTo
    {
        return $this->belongsTo(Prayer::class);
    }
}
