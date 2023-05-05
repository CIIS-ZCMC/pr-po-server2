<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Profile::truncate();

        

        Profile::create([
            'fname' => "Dennis",
            'mname' => "Natividad",
            'lname' => "Falcasantos",
            'ext_name' => "",
            'contact' => "09123456789",
            'FK_address_ID' => 1,
            'FK_user_ID' => 1
        ]);

        Profile::create([
            'fname' => "Alyana",
            'mname' => "NONE",
            'lname' => "Baretto",
            'ext_name' => "",
            'contact' => "09123456781",
            'FK_address_ID' => 2,
            'FK_user_ID' => 2
        ]);

        Profile::create([
            'fname' => "Reenjay",
            'mname' => "NONE",
            'lname' => "Caimor",
            'ext_name' => "",
            'contact' => "09123456783",
            'FK_address_ID' => 3,
            'FK_user_ID' => 3
        ]);

        Profile::create([
            'fname' => "Krizzelle",
            'mname' => "NONE",
            'lname' => "Falcasantos",
            'ext_name' => "",
            'contact' => "09123456784",
            'FK_address_ID' => 4,
            'FK_user_ID' => 4
        ]);

        Profile::create([
            'fname' => "Kim",
            'mname' => "NONE",
            'lname' => "Dolar",
            'ext_name' => "",
            'contact' => "09123456784",
            'FK_address_ID' => 5,
            'FK_user_ID' => 5
        ]);

        Profile::create([
            'fname' => "Nuradia",
            'mname' => "NONE",
            'lname' => "Lagoyo",
            'ext_name' => "",
            'contact' => "09123456724",
            'FK_address_ID' => 6,
            'FK_user_ID' => 6
        ]);

        Profile::create([
            'fname' => "John",
            'mname' => "NONE",
            'lname' => "Sta Teresa",
            'ext_name' => "",
            'contact' => "09123456721",
            'FK_address_ID' => 7,
            'FK_user_ID' => 7
        ]);

        Profile::create([
            'fname' => "Dr. Abdal",
            'mname' => "B",
            'lname' => "Kunting",
            'ext_name' => "",
            'contact' => "09123456723",
            'FK_address_ID' => 8,
            'FK_user_ID' => 8
        ]);

        Profile::create([
            'fname' => "Tristan",
            'mname' => "NONE",
            'lname' => "Amit",
            'ext_name' => "",
            'contact' => "09123456723",
            'FK_address_ID' => 9,
            'FK_user_ID' => 9
        ]);

        Profile::create([
            'fname' => "Yara",
            'mname' => "NONE",
            'lname' => "Que",
            'ext_name' => "",
            'contact' => "09123456123",
            'FK_address_ID' => 10,
            'FK_user_ID' => 10
        ]);
    }
}
