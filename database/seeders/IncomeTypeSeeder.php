<?php

namespace Database\Seeders;

use App\Models\IncomeType;
use Illuminate\Database\Seeder;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomes = [
            // Halal Industries
            [
                'title' => 'Software Engineer / IT Professional',
                'category' => 'halal',
                'industry' => 'Technology',
                'explanation' => 'Creating software, mobile apps, website designs, or IT infrastructure for general business use, healthcare, education, or halal services is highly encouraged and falls under providing useful tools for humanity.',
                'quran_reference' => null,
                'hadith_id' => 46,
            ],
            [
                'title' => 'Retail Shop Owner / Merchant',
                'category' => 'halal',
                'industry' => 'Commerce',
                'explanation' => 'Trading in permissible goods like clothes, electronics, books, etc. is highly blessed in Islam. The Prophet ﷺ praised truthful and honest merchants, placing them alongside prophets and martyrs.',
                'quran_reference' => null,
                'hadith_id' => 50,
            ],
            [
                'title' => 'Medical Professional (Doctor / Nurse)',
                'category' => 'halal',
                'industry' => 'Healthcare',
                'explanation' => 'Healing, treating patients, prescribing medications, and nursing the sick are noble actions that are highly rewarded under the concept of serving creation and preserving life.',
                'quran_reference' => 'Surah Al-Ma\'idah 5:32 ("Whoever saves a life, it is as if he saved all of mankind")',
                'hadith_id' => 47,
            ],
            [
                'title' => 'Agriculturalist / Farmer',
                'category' => 'halal',
                'industry' => 'Agriculture',
                'explanation' => 'Cultivating land and planting crops is highly recommended. The Prophet ﷺ stated that whatever is eaten from a plant cultivated by a Muslim is counted as charity for him.',
                'quran_reference' => null,
                'hadith_id' => 48,
            ],
            [
                'title' => 'Civil Engineer / Architect',
                'category' => 'halal',
                'industry' => 'Construction',
                'explanation' => 'Designing and erecting residential buildings, bridges, and infrastructure that benefit the community is a praiseworthy source of livelihood.',
                'quran_reference' => null,
                'hadith_id' => 48,
            ],

            // Haram Industries
            [
                'title' => 'Conventional Bank Employee (Interest-based)',
                'category' => 'haram',
                'industry' => 'Finance',
                'explanation' => 'Working in positions that directly involve dealing, calculating, recording, or witnessing interest (Riba) is prohibited, as the Prophet ﷺ cursed the consumer, writer, and witnesses of Riba.',
                'quran_reference' => 'Surah Al-Baqarah 2:275-279 ("Allah has permitted trade and forbidden interest")',
                'hadith_id' => 49,
            ],
            [
                'title' => 'Casino / Gambling Host or Croupier',
                'category' => 'haram',
                'industry' => 'Entertainment',
                'explanation' => 'Gambling (Maisir) is strictly prohibited in the Quran. Working in a casino, creating gambling software, or operating betting services directly facilitates sin.',
                'quran_reference' => 'Surah Al-Ma\'idah 5:90',
                'hadith_id' => null,
            ],
            [
                'title' => 'Brewer / Alcohol Salesperson',
                'category' => 'haram',
                'industry' => 'Food & Beverage',
                'explanation' => 'Selling, brewing, distributing, or serving alcoholic beverages is completely forbidden. The Prophet ﷺ cursed ten categories of people related to alcohol, including the one who presses it, the seller, and the carrier.',
                'quran_reference' => null,
                'hadith_id' => null,
            ],
            [
                'title' => 'Pork Slaughterer / Distributor',
                'category' => 'haram',
                'industry' => 'Food & Beverage',
                'explanation' => 'Farming, slaughtering, processing, or selling pork products is forbidden, as pig meat is explicitly declared impure and forbidden to buy or sell.',
                'quran_reference' => 'Surah Al-Ma\'idah 5:3',
                'hadith_id' => null,
            ],

            // Doubtful Industries
            [
                'title' => 'Advertising Specialist for Mixed Brands',
                'category' => 'doubtful',
                'industry' => 'Marketing',
                'explanation' => 'If the ads promote halal brands, it is permissible. However, if the ads promote mixed products or display prohibited imagery (e.g. immodest scenes), the income becomes doubtful. A Muslim should seek clean marketing projects.',
                'quran_reference' => null,
                'hadith_id' => null,
            ],
            [
                'title' => 'Day Trader (Speculative Forex or Crypto Trading)',
                'category' => 'doubtful',
                'industry' => 'Finance',
                'explanation' => 'Highly speculative fast-paced trading (leverage, futures, options, short-selling) often border on gambling (Gharar) and lack physical assets/possession rules of Islamic trade. Spot trading with actual possession is generally halal, but speculative trading is doubtful.',
                'quran_reference' => null,
                'hadith_id' => 50,
            ],
            [
                'title' => 'Music Streaming Platform Developer',
                'category' => 'doubtful',
                'industry' => 'Entertainment',
                'explanation' => 'Working on the code or hosting of platforms that predominantly stream musical content, which a large body of Islamic scholars consider forbidden or highly disliked, is considered doubtful. Developers should seek general tech roles.',
                'quran_reference' => null,
                'hadith_id' => null,
            ],
        ];

        foreach ($incomes as $income) {
            IncomeType::create($income);
        }
    }
}
