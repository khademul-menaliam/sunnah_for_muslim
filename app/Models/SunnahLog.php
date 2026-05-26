<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'sunnah_id',
    'date',
    'completed',
    'notes',
])]
class SunnahLog extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'completed' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the log.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the sunnah being logged.
     *
     * @return BelongsTo<Sunnah, $this>
     */
    public function sunnah(): BelongsTo
    {
        return $this->belongsTo(Sunnah::class);
    }
}
