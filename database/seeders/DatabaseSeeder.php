<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Chicken;
use App\Models\CareLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::create([
            'name' => 'Farm Manager (Admin)',
            'email' => 'admin@farm.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create Caretaker User
        $caretaker = User::create([
            'name' => 'John Caretaker',
            'email' => 'caretaker@farm.com',
            'password' => Hash::make('password'),
            'role' => 'caretaker',
        ]);

        // 3. Create Sample Chickens
        $chicken1 = Chicken::create([
            'name' => 'Chicken A (Tag 001)',
            'breed' => 'Rhode Island Red',
            'acquired_at' => '2026-01-10',
            'caretaker_id' => $caretaker->id,
        ]);

        $chicken2 = Chicken::create([
            'name' => 'Chicken B (Tag 002)',
            'breed' => 'Leghorn',
            'acquired_at' => '2026-02-15',
            'caretaker_id' => $caretaker->id,
        ]);

        $chicken3 = Chicken::create([
            'name' => 'Chicken C (Tag 003)',
            'breed' => 'Plymouth Rock',
            'acquired_at' => '2026-03-20',
            'caretaker_id' => null, // Unassigned
        ]);

        // 4. Create Sample Care Log for Today
        CareLog::create([
            'chicken_id' => $chicken1->id,
            'user_id' => $caretaker->id,
            'date' => now()->toDateString(),
            'feed_type' => 'Layer Pellets',
            'feed_quantity' => '500g',
            'feed_time' => '08:00:00',
            'health_status' => 'Healthy',
            'health_symptoms' => null,
            'eggs_collected' => 2,
        ]);
    }
}
