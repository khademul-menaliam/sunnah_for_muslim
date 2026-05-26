<?php

namespace Database\Seeders;

use App\Models\Prayer;
use Illuminate\Database\Seeder;

class PrayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prayers = [
            [
                'id' => 1,
                'name' => 'Fajr',
                'arabic_name' => 'الفجر',
                'transliteration' => 'Al-Fajr',
                'order_number' => 1,
                'rakat_fard' => 2,
                'rakat_sunnah_before' => 2,
                'rakat_sunnah_after' => 0,
                'rakat_nafl' => 0,
                'time_window_description' => 'From the beginning of dawn (true dawn) until sunrise.',
                'significance' => 'The dawn prayer holds immense spiritual blessing. Praying Fajr in congregation or on time places a believer under the direct protection of Allah for the entire day. The two sunnah rakat before Fajr are described as better than this world and everything in it.',
                'special_notes' => 'Recitation is performed aloud (Jahri) in the Fard rakat.',
            ],
            [
                'id' => 2,
                'name' => 'Dhuhr',
                'arabic_name' => 'الظهر',
                'transliteration' => 'Ad-Dhuhr',
                'order_number' => 2,
                'rakat_fard' => 4,
                'rakat_sunnah_before' => 4,
                'rakat_sunnah_after' => 2,
                'rakat_nafl' => 2,
                'time_window_description' => 'From the zenith (when the sun passes the meridian) until the shadow of an object becomes equal to its length (or twice its length, according to Hanafi school).',
                'significance' => 'The midday prayer signifies our turning back to Allah amidst our daily chores, business, and study. Consistently observing the sunnah before and after Dhuhr shields a person from hellfire.',
                'special_notes' => 'On Friday, Jumu\'ah prayer replaces Dhuhr for men in congregation, consisting of a Khutbah (sermon) and 2 Fard rakat. Recitation is silent (Sirri).',
            ],
            [
                'id' => 3,
                'name' => 'Asr',
                'arabic_name' => 'العصر',
                'transliteration' => 'Al-Asr',
                'order_number' => 3,
                'rakat_fard' => 4,
                'rakat_sunnah_before' => 4,
                'rakat_sunnah_after' => 0,
                'rakat_nafl' => 0,
                'time_window_description' => 'From the end of Dhuhr time until the sun begins to turn yellow/sunset.',
                'significance' => 'The middle prayer. Allah explicitly commands us to guard our prayers, especially the middle one. Missing Asr is described in hadiths as if one has lost their family and property.',
                'special_notes' => 'There are no sunnah ba\'diyah (after) prayers for Asr. The 4 sunnah before are highly recommended voluntary prayers. Recitation is silent (Sirri).',
            ],
            [
                'id' => 4,
                'name' => 'Maghrib',
                'arabic_name' => 'المغرب',
                'transliteration' => 'Al-Maghrib',
                'order_number' => 4,
                'rakat_fard' => 3,
                'rakat_sunnah_before' => 2,
                'rakat_sunnah_after' => 2,
                'rakat_nafl' => 2,
                'time_window_description' => 'From immediately after sunset until the red twilight disappears from the sky.',
                'significance' => 'Maghrib represents the transition from day to night. It is a time of swift transition, and breaking fast (Iftar) occurs at this time. It holds immense rewards for those who hasten to pray it.',
                'special_notes' => 'Recitation is performed aloud (Jahri) in the first two Fard rakat. The 2 sunnah after are highly emphasized sunnah mu\'akkadah.',
            ],
            [
                'id' => 5,
                'name' => 'Isha',
                'arabic_name' => 'العشاء',
                'transliteration' => 'Al-Isha',
                'order_number' => 5,
                'rakat_fard' => 4,
                'rakat_sunnah_before' => 4,
                'rakat_sunnah_after' => 2,
                'rakat_nafl' => 2,
                'time_window_description' => 'From when the red twilight disappears until midnight (or before dawn, as a necessity).',
                'significance' => 'The night prayer. Isha in congregation is equivalent to standing in prayer for half the night. It is a beautiful conclusion to the believer\'s day, followed by the highly emphasized Witr prayer.',
                'special_notes' => 'Recitation is performed aloud (Jahri) in the first two Fard rakat. The Witr prayer (3 rakat in Hanafi or 1/3 in other schools) is performed after Isha or before sleeping.',
            ],
        ];

        foreach ($prayers as $prayer) {
            Prayer::updateOrCreate(['id' => $prayer['id']], $prayer);
        }
    }
}
