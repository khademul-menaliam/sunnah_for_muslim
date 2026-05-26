<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default test user with location settings
        User::factory()->create([
            'name' => 'Khademul Islam',
            'email' => 'user@deen.test',
            'password' => bcrypt('password'),
            'city' => 'Dhaka',
            'country' => 'Bangladesh',
            'latitude' => 23.8103,
            'longitude' => 90.4125,
            'madhab' => 'Hanafi',
            'language' => 'en',
            'prayer_calculation_method' => 'Karachi',
            'notification_preferences' => [
                'salah_alerts' => true,
                'daily_sunnah' => true,
                'zakat_reminders' => true,
            ],
        ]);

        // Run the specific module seeders
        $this->call([
            PrayerSeeder::class,
            HadithSeeder::class,
            SunnahSeeder::class,
            FoodSeeder::class,
            EatingEtiquetteSeeder::class,
            IncomeTypeSeeder::class,
            IslamicFinanceConceptSeeder::class,
            BusinessEthicSeeder::class,
            AdhkarSeeder::class,
        ]);
    }
}
