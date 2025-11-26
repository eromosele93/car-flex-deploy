<?php

namespace Database\Seeders;

use App\Models\Buy;
use App\Models\Rent;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Eromosele Okoudoh',
             'email' => 'eromosele.okoudoh@gmail.com',
             'is_admin' => true
          ]);
          User::factory()->create([
             'name' => 'Jude James',
              'email' => 'judejames@gmail.com',
           ]);
         Buy::factory(20)->create([
             'user_id' => 1
         ]);
         Buy::factory(20)->create([
             'user_id' => 2
         ]);
         Rent::factory(20)->create([
            'user_id' => 1
        ]);
        Rent::factory(20)->create([
            'user_id' => 2
        ]);
    }
}
