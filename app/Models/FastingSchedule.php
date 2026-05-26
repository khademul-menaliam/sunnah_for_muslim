<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'year',
    'ramadan_start',
    'ramadan_end',
    'suhoor_time',
    'iftar_time',
    'location',
    'notes',
])]
class FastingSchedule extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'ramadan_start' => 'date',
            'ramadan_end' => 'date',
        ];
    }

    /**
     * Get the user that owns the fasting schedule.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
