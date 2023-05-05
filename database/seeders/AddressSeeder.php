<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Address::truncate();

        Address::create([
            'street' => "1st Street",
            'barangay' => "Pasonanca",
            'city' => "Zamboanga City",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
