<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'name',
    'category',
    'arabic_text',
    'transliteration',
    'translation',
    'repetitions',
    'source',
    'time_of_day',
])]
class Adhkar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adhkars';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'repetitions' => 'integer',
        ];
    }
}
