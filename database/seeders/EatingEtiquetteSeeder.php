<?php

namespace Database\Seeders;

use App\Models\EatingEtiquette;
use Illuminate\Database\Seeder;

class EatingEtiquetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $etiquettes = [
            [
                'title' => 'Washing both hands before eating',
                'description' => 'Washing the hands thoroughly to remove dirt and bacteria before sitting down for a meal.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => null,
                'order_number' => 1,
            ],
            [
                'title' => 'Saying Bismillah (In the Name of Allah)',
                'description' => 'Reciting "Bismillah" before taking the first bite to invite blessings and block Satan.',
                'type' => 'sunnah',
                'arabic_text' => 'بِسْمِ اللَّهِ',
                'hadith_id' => 11,
                'order_number' => 2,
            ],
            [
                'title' => 'Eating with the right hand',
                'description' => 'Always using the right hand to handle, bite, and chew food, leaving the left hand for other utilities.',
                'type' => 'sunnah',
                'arabic_text' => 'كُلْ بِيَمِينِكَ',
                'hadith_id' => 11,
                'order_number' => 3,
            ],
            [
                'title' => 'Eating from what is nearest to you',
                'description' => 'Eating from the side of the plate or serving dish closest to you instead of reaching across.',
                'type' => 'sunnah',
                'arabic_text' => 'وَكُلْ مِمَّا يَلِيكَ',
                'hadith_id' => 11,
                'order_number' => 4,
            ],
            [
                'title' => 'Sitting down while eating and drinking',
                'description' => 'Ensuring you are seated comfortably rather than walking or standing while eating.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 21,
                'order_number' => 5,
            ],
            [
                'title' => 'Eating together in groups or with family',
                'description' => 'Sharing the food collectively on a single platter or table, which increases the blessing.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 23,
                'order_number' => 6,
            ],
            [
                'title' => 'Not blowing into hot food or drinks',
                'description' => 'Letting food or tea cool down on its own instead of blowing air onto it from your mouth.',
                'type' => 'prohibition',
                'arabic_text' => null,
                'hadith_id' => 22,
                'order_number' => 7,
            ],
            [
                'title' => 'Eating in three breaths when drinking',
                'description' => 'Removing the cup from the mouth three times to breathe comfortably rather than drinking in a single gulp.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 22,
                'order_number' => 8,
            ],
            [
                'title' => 'Never criticizing or complaining about food',
                'description' => 'Accepting food with gratitude. If you do not like the taste, leave it silently without making derogatory remarks.',
                'type' => 'adab',
                'arabic_text' => null,
                'hadith_id' => 15,
                'order_number' => 9,
            ],
            [
                'title' => 'Picking up fallen food morsels',
                'description' => 'Wiping off any dust from a dropped bite and eating it to show humility and prevent waste.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 16,
                'order_number' => 10,
            ],
            [
                'title' => 'Applying the "Rule of Thirds" (Moderation)',
                'description' => 'Filling the stomach with only one-third food, one-third water, and leaving one-third for breathing.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 12,
                'order_number' => 11,
            ],
            [
                'title' => 'Licking the fingers before wiping or washing',
                'description' => 'Licking the fingers cleanly after finishing a meal to capture the final traces of blessing.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 14,
                'order_number' => 12,
            ],
            [
                'title' => 'Praising Allah after finishing the meal',
                'description' => 'Reciting Alhamdu lillah or the prescribed after-meal dua to express gratitude.',
                'type' => 'sunnah',
                'arabic_text' => 'الْحَمْدُ لِلَّهِ',
                'hadith_id' => 20,
                'order_number' => 13,
            ],
            [
                'title' => 'Eating from the sides of the bowl first',
                'description' => 'Starting to eat from the sides of the plate rather than digging into the center, as blessing descends in the center.',
                'type' => 'adab',
                'arabic_text' => null,
                'hadith_id' => 13,
                'order_number' => 14,
            ],
            [
                'title' => 'Washing the mouth and hands after eating',
                'description' => 'Rinsing the mouth and washing the hands thoroughly with soap or water to clean oil and food residues.',
                'type' => 'adab',
                'arabic_text' => null,
                'hadith_id' => null,
                'order_number' => 15,
            ],
            [
                'title' => 'Serving others before yourself',
                'description' => 'The host or younger person should serve others first, particularly elders and guests.',
                'type' => 'adab',
                'arabic_text' => null,
                'hadith_id' => null,
                'order_number' => 16,
            ],
            [
                'title' => 'Saying Bismillah Awwalahu wa Akhirahu if forgotten',
                'description' => 'If you forget to say Bismillah at the start, say "Bismillahi Awwalahu wa Akhirahu" when you remember during the meal.',
                'type' => 'sunnah',
                'arabic_text' => 'بِسْمِ اللَّهِ أَوَّلَهُ وَآخِرَهُ',
                'hadith_id' => null,
                'order_number' => 17,
            ],
            [
                'title' => 'Chewing food thoroughly',
                'description' => 'Chewing food slowly and completely, which aids in digestion and promotes mindfulness.',
                'type' => 'adab',
                'arabic_text' => null,
                'hadith_id' => null,
                'order_number' => 18,
            ],
            [
                'title' => 'Not eating while lying down or leaning',
                'description' => 'Avoiding leaning on one\'s side or lying down while consuming food, as it is harmful for digestion.',
                'type' => 'prohibition',
                'arabic_text' => null,
                'hadith_id' => null,
                'order_number' => 19,
            ],
            [
                'title' => 'Using three fingers to eat',
                'description' => 'Eating with the thumb, index, and middle fingers when consuming dry foods or dates.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 14,
                'order_number' => 20,
            ],
            [
                'title' => 'Cleaning the plate completely',
                'description' => 'Wiping the bowl or plate clean so no food is wasted, as one does not know which grain contains the blessing.',
                'type' => 'sunnah',
                'arabic_text' => null,
                'hadith_id' => 14,
                'order_number' => 21,
            ],
        ];

        foreach ($etiquettes as $etiquette) {
            EatingEtiquette::create($etiquette);
        }
    }
}
