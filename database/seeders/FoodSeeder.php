<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            // ================= HARAM FOODS =================
            [
                'name' => 'Pork and Swine Flesh',
                'arabic_name' => 'لحم الخنزير',
                'status' => 'haram',
                'category' => 'meat',
                'reason' => 'Explicitly forbidden in the Quran in multiple verses. Swine are considered impure (Rijs) and highly detrimental to physical and spiritual health.',
                'quran_reference' => 'Surah Al-Baqarah 2:173, Surah Al-Ma\'idah 5:3',
                'hadith_id' => null,
            ],
            [
                'name' => 'Alcoholic Beverages and Wine',
                'arabic_name' => 'الخمر',
                'status' => 'haram',
                'category' => 'beverage',
                'reason' => 'All intoxicants are haram. Intoxication impairs the intellect, leads to sinful behavior, and negates prayers for forty days unless the person repents.',
                'quran_reference' => 'Surah Al-Ma\'idah 5:90',
                'hadith_id' => null,
            ],
            [
                'name' => 'Blood (Spilt/Liquid)',
                'arabic_name' => 'الدم المسفوح',
                'status' => 'haram',
                'category' => 'additive',
                'reason' => 'Liquid blood that flows from an animal when slaughtered is strictly prohibited. It carries toxins and metabolic wastes.',
                'quran_reference' => 'Surah Al-An\'am 6:145',
                'hadith_id' => null,
            ],
            [
                'name' => 'Meat of Carnivorous Animals (Lions, Tigers, Wolves)',
                'arabic_name' => 'سباع البهائم',
                'status' => 'haram',
                'category' => 'meat',
                'reason' => 'Forbidden by the Prophet ﷺ. Any wild beast with canine teeth/fangs is haram to consume.',
                'quran_reference' => null,
                'hadith_id' => null,
            ],
            [
                'name' => 'Birds of Prey with Talons (Eagles, Hawks, Falcons)',
                'arabic_name' => 'الطيور ذات المخلب',
                'status' => 'haram',
                'category' => 'meat',
                'reason' => 'The Prophet ﷺ prohibited eating any bird that possesses talons for hunting.',
                'quran_reference' => null,
                'hadith_id' => null,
            ],

            // ================= HALAL / BLESSED FOODS =================
            [
                'name' => 'Ajwa Dates',
                'arabic_name' => 'التمر',
                'status' => 'halal',
                'category' => 'fruit',
                'reason' => 'A supreme Quranic food. Dates are highly nutritious, rich in natural sugars, fiber, and potassium. The Prophet ﷺ stated that eating seven Ajwa dates in the morning protects from poison and magic.',
                'quran_reference' => 'Surah Maryam 19:25',
                'hadith_id' => 19,
            ],
            [
                'name' => 'Pure Natural Honey',
                'arabic_name' => 'العسل',
                'status' => 'halal',
                'category' => 'additive',
                'reason' => 'Described by Allah as containing a cure for mankind. It acts as a natural antibiotic, antioxidant, throat soother, and energy booster.',
                'quran_reference' => 'Surah An-Nahl 16:69',
                'hadith_id' => null,
            ],
            [
                'name' => 'Extra Virgin Olive Oil',
                'arabic_name' => 'زيت الزيتون',
                'status' => 'halal',
                'category' => 'additive',
                'reason' => 'Olives are mentioned as coming from a blessed tree. Olive oil is excellent for cardiovascular health, reduces bad cholesterol, and nourishes the skin and hair.',
                'quran_reference' => 'Surah An-Nur 24:35, Surah At-Tin 95:1',
                'hadith_id' => null,
            ],
            [
                'name' => 'Sweet Pomegranate',
                'arabic_name' => 'الرمان',
                'status' => 'halal',
                'category' => 'fruit',
                'reason' => 'Described as a fruit of Paradise. Pomegranates are loaded with vitamin C, potassium, and powerful anti-inflammatory compounds that promote digestive health.',
                'quran_reference' => 'Surah Al-An\'am 6:99, Surah Ar-Rahman 55:68',
                'hadith_id' => null,
            ],
            [
                'name' => 'Fresh Figs',
                'arabic_name' => 'التين',
                'status' => 'halal',
                'category' => 'fruit',
                'reason' => 'Allah swears by the Fig in the Quran. Figs are rich in calcium, iron, and fiber, facilitating digestive health and bone strength.',
                'quran_reference' => 'Surah At-Tin 95:1',
                'hadith_id' => null,
            ],
            [
                'name' => 'Black Seed (Habbat al-Barakah)',
                'arabic_name' => 'الحبة السوداء',
                'status' => 'halal',
                'category' => 'grain',
                'reason' => 'The Prophet ﷺ described the black seed as a cure for every disease except death. It is an extraordinary immune system stimulant and respiratory remedy.',
                'quran_reference' => null,
                'hadith_id' => 25,
            ],

            // ================= MAKRUH / DOUBTFUL =================
            [
                'name' => 'Cigarettes and Hookah (Tobacco)',
                'arabic_name' => 'التبغ',
                'status' => 'makruh',
                'category' => 'beverage',
                'reason' => 'Considered highly offensive, bad-smelling, and harmful to the body. Many modern scholars classify smoking as haram due to its proven lethal health risks.',
                'quran_reference' => 'Surah Al-Baqarah 2:195 ("Do not throw yourselves into destruction")',
                'hadith_id' => null,
            ],
            [
                'name' => 'Cochineal Extract (Carminic Acid / E120)',
                'arabic_name' => 'الملون الأحمر E120',
                'status' => 'doubtful',
                'category' => 'additive',
                'reason' => 'A red food dye made from crushed female cochineal insects. Because eating insects (other than locusts) is forbidden in several Islamic schools, some scholars deem this additive doubtful or haram, while others allow it if fully chemically processed (Istihalah).',
                'quran_reference' => null,
                'hadith_id' => null,
            ],
            [
                'name' => 'Gelatin (Derived from Non-Halal Slaughter)',
                'arabic_name' => 'الجيلاتين غير الحلال',
                'status' => 'doubtful',
                'category' => 'additive',
                'reason' => 'If gelatin is derived from pigs, it is strictly haram. If derived from cows/animals slaughtered in a non-halal manner, it is considered doubtful. Safe alternatives are plant-based agar-agar or halal bovine gelatin.',
                'quran_reference' => null,
                'hadith_id' => null,
            ],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
