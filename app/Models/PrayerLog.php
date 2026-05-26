<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'prayer_id',
    'date',
    'status',
    'prayed_at',
    'notes',
])]
class PrayerLog extends Model
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
            'prayed_at' => 'datetime',
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
     * Get the prayer that is logged.
     *
     * @return BelongsTo<Prayer, $this>
     */
    public function prayer(): BelongsTo
    {
        return $this->belongsTo(Prayer::class);
    }
}
