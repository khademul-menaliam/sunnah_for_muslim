<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'arabic_name',
    'transliteration',
    'order_number',
    'rakat_fard',
    'rakat_sunnah_before',
    'rakat_sunnah_after',
    'rakat_nafl',
    'time_window_description',
    'significance',
    'special_notes',
])]
class Prayer extends Model
{
    /**
     * Get the hadiths associated with the prayer.
     *
     * @return HasMany<Hadith, $this>
     */
    public function hadiths(): HasMany
    {
        return $this->hasMany(Hadith::class);
    }

    /**
     * Get the logs associated with the prayer.
     *
     * @return HasMany<PrayerLog, $this>
     */
    public function logs(): HasMany
    {
        return $this->hasMany(PrayerLog::class);
    }
}
