<?php

namespace Database\Seeders;

use App\Models\BusinessEthic;
use Illuminate\Database\Seeder;

class BusinessEthicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ethics = [
            // Prohibited/Forbidden Ethics
            [
                'principle' => 'Strict Prohibition of Usury and Interest (Riba) in any financial transactions.',
                'quran_reference' => 'Surah Al-Baqarah 2:275-279',
                'hadith_id' => 49,
                'category' => 'forbidden',
            ],
            [
                'principle' => 'Prohibition of Hiding Product Defects (Ghash) and cheating or deceiving buyers.',
                'quran_reference' => 'Surah Al-Mutaffifin 83:1-3',
                'hadith_id' => 52,
                'category' => 'forbidden',
            ],
            [
                'principle' => 'Prohibition of Hoarding Goods (Ihtikar) to artificially inflate market prices.',
                'quran_reference' => null,
                'hadith_id' => 50,
                'category' => 'forbidden',
            ],
            [
                'principle' => 'Prohibition of False Oaths and exaggerated advertising claims to sell products.',
                'quran_reference' => null,
                'hadith_id' => 50,
                'category' => 'forbidden',
            ],
            [
                'principle' => 'Prohibition of Short-measuring or cheating in weight and scale measurements.',
                'quran_reference' => 'Surah Al-Mutaffifin 83:1-3, Surah Al-An\'am 6:152',
                'hadith_id' => null,
                'category' => 'forbidden',
            ],

            // Recommended/Encouraged Ethics
            [
                'principle' => 'Honesty, truthfulness, and transparency in declaring cost and defect.',
                'quran_reference' => 'Surah An-Nisa 4:29',
                'hadith_id' => 50,
                'category' => 'recommended',
            ],
            [
                'principle' => 'Elenience, kindness, and flexibility in sales, purchase, and debt collection.',
                'quran_reference' => null,
                'hadith_id' => 51,
                'category' => 'recommended',
            ],
            [
                'principle' => 'Prompt and fair payment of laborers\' and employees\' wages.',
                'quran_reference' => null,
                'hadith_id' => 53,
                'category' => 'recommended',
            ],
            [
                'principle' => 'Extending Qard Hasan (interest-free benevolent loans) to those in financial distress.',
                'quran_reference' => 'Surah Al-Hadid 57:11',
                'hadith_id' => 51,
                'category' => 'recommended',
            ],
            [
                'principle' => 'Showing gratitude to business associates, suppliers, and clients.',
                'quran_reference' => 'Surah Ibrahim 14:7',
                'hadith_id' => 55,
                'category' => 'recommended',
            ],
        ];

        foreach ($ethics as $ethic) {
            BusinessEthic::create($ethic);
        }
    }
}
