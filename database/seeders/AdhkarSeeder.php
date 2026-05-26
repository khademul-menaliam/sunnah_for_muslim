<?php

namespace Database\Seeders;

use App\Models\Adhkar;
use Illuminate\Database\Seeder;

class AdhkarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adhkars = [
            // Morning Adhkar
            [
                'name' => 'Al-Mu\'awwidhat (Three Quls)',
                'category' => 'morning',
                'arabic_text' => 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ {قُلْ هُوَ اللَّهُ أَحَدٌ...} {قُلْ أَعُوذُ بِرَبِّ الْفَلَقِ...} {قُلْ أَعُوذُ بِرَبِّ النَّاسِ...}',
                'transliteration' => 'Recite Surah Al-Ikhlas, Surah Al-Falaq, and Surah An-Nas.',
                'translation' => 'Recite the three protective chapters of the Quran. (Ikhlas, Falaq, Nas)',
                'repetitions' => 3,
                'source' => 'Jami at-Tirmidhi 3575, Abu Dawud 5082',
                'time_of_day' => 'morning',
            ],
            [
                'name' => 'Sayyidul Istighfar (The Master Supplication for Forgiveness)',
                'category' => 'morning',
                'arabic_text' => 'اللَّهُمَّ أَنْتَ رَبِّي لَا إِلَهَ إِلَّا أَنْتَ خَلَقْتَنِي وَأَنَا عَبْدُكَ وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ أَعُوذُ بِكَ مِنْ شَرِّ مَا صَنَعْتُ أَبُوءُ لَكَ بِنِعْمَتِكَ عَلَيَّ وَأَبُوءُ لَكَ بِذَنْبِي فَاغْفِرْ لِي فَإِنَّهُ لَا يَغْفِرُ الذُّنُوبَ إِلَّا أَنْتَ',
                'transliteration' => 'Allahumma anta rabbi la ilaha illa anta khalaqtani wa ana \'abduka wa ana \'ala \'ahdika wa wa\'dika mastata\'tu, a\'udhu bika min sharri ma sana\'tu, abu\'u laka bini\'matika \'alayya wa abu\'u laka bidhanbi faghfir li fa innahu la yaghfirudh-dhunuba illa anta.',
                'translation' => 'O Allah, You are my Lord, none has the right to be worshipped except You. You created me and I am Your servant, and I abide by Your covenant and promise as best I can. I seek refuge in You from the evil of what I have done. I acknowledge Your grace upon me and I acknowledge my sin, so forgive me, for none forgives sins except You.',
                'repetitions' => 1,
                'source' => 'Sahih Bukhari 6306',
                'time_of_day' => 'morning',
            ],
            [
                'name' => 'Protection from Harm',
                'category' => 'morning',
                'arabic_text' => 'بِسْمِ اللَّهِ الَّذِي لَا يَضُرُّ مَعَ اسْمِهِ شَيْءٌ فِي الْأَرْضِ وَلَا فِي السَّمَاءِ وَهُوَ السَّمِيعُ الْعَلِيمُ',
                'transliteration' => 'Bismillahilladhi la yadurru ma\'asmihi shay\'un fil-ardi wa la fis-sama\'i wa huwas-sami\'ul-\'alim.',
                'translation' => 'In the name of Allah, by whose name nothing in the earth or in the heavens can cause harm, and He is the All-Hearing, the All-Knowing.',
                'repetitions' => 3,
                'source' => 'Sunan Abu Dawud 5088, Tirmidhi 3388',
                'time_of_day' => 'morning',
            ],

            // Evening Adhkar
            [
                'name' => 'Al-Mu\'awwidhat (Three Quls)',
                'category' => 'evening',
                'arabic_text' => 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ {قُلْ هُوَ اللَّهُ أَحَدٌ...} {قُلْ أَعُوذُ بِرَبِّ الْفَلَقِ...} {قُلْ أَعُوذُ بِرَبِّ النَّاسِ...}',
                'transliteration' => 'Recite Surah Al-Ikhlas, Surah Al-Falaq, and Surah An-Nas.',
                'translation' => 'Recite the three protective chapters of the Quran. (Ikhlas, Falaq, Nas)',
                'repetitions' => 3,
                'source' => 'Jami at-Tirmidhi 3575, Abu Dawud 5082',
                'time_of_day' => 'evening',
            ],
            [
                'name' => 'Seeking Refuge in Allah\'s Perfect Words',
                'category' => 'evening',
                'arabic_text' => 'أَعُوذُ بِكَلِمَاتِ اللَّهِ التَّامَّاتِ مِنْ شَرِّ مَا خَلَقَ',
                'transliteration' => 'A\'udhu bi kalimatillahit-tammati min sharri ma khalaq.',
                'translation' => 'I seek refuge in the perfect words of Allah from the evil of what He has created.',
                'repetitions' => 3,
                'source' => 'Sahih Muslim 2709',
                'time_of_day' => 'evening',
            ],

            // Before Sleep
            [
                'name' => 'Ayat al-Kursi (The Throne Verse)',
                'category' => 'before_sleep',
                'arabic_text' => 'اللَّهُ لَا إِلَهَ إِلَّا هُوَ الْحَيُّ الْقَيُّومُ لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ لَّهُ مَا فِي السَّمَاوَاتِ وَمَا فِي الْأَرْضِ...',
                'transliteration' => 'Allahu la ilaha illa huwal-hayyul-qayyum, la ta\'khudhuhu sinatun wa la nawm...',
                'translation' => 'Allah! There is no deity except Him, the Ever-Living, the Sustainer of all existence. Neither drowsiness overtakes Him nor sleep. To Him belongs whatever is in the heavens and whatever is on the earth...',
                'repetitions' => 1,
                'source' => 'Sahih Bukhari 2311',
                'time_of_day' => 'night',
            ],
            [
                'name' => 'In Your Name I Die and Live',
                'category' => 'before_sleep',
                'arabic_text' => 'بِاسْمِكَ اللَّهُمَّ أَمُوتُ وَأَحْيَا',
                'transliteration' => 'Bismika allahumma amutu wa ahya.',
                'translation' => 'In Your name, O Allah, I die and I live.',
                'repetitions' => 1,
                'source' => 'Sahih Bukhari 6324, Sahih Muslim 2711',
                'time_of_day' => 'night',
            ],

            // After Prayer
            [
                'name' => 'Tasbih, Tahmid, Takbir',
                'category' => 'after_prayer',
                'arabic_text' => 'سُبْحَانَ اللَّهِ (٣٣) الْحَمْدُ لِلَّهِ (٣٣) اللَّهُ أَكْبَرُ (٣٣) لَا إِلَهَ إِلَّا اللَّهُ وَحْدَهُ لَا شَرِيكَ لَهُ لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ وَهُوَ عَلَى كُلِّ شَيْءٍ قَدِيرٌ (١)',
                'transliteration' => 'Subhanallah (33x), Alhamdulillah (33x), Allahu Akbar (33x), followed once by La ilaha illallahu wahdahu la sharika lahu...',
                'translation' => 'Glory be to Allah (33 times), Praise be to Allah (33 times), Allah is the Greatest (33 times), finishing with: There is no deity except Allah alone, without partner; to Him belongs dominion and to Him belongs praise, and He is over all things powerful.',
                'repetitions' => 33,
                'source' => 'Sahih Muslim 597',
                'time_of_day' => 'general',
            ],
        ];

        foreach ($adhkars as $adhkar) {
            Adhkar::create($adhkar);
        }
    }
}
