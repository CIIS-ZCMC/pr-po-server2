<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        User::truncate();

        User::create([
            'email' => 'ciisZCMC@gmail.com',
            'FK_role_ID' => 1,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'admin@gmail.com',
            'FK_role_ID' => 2,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'department@gmail.com',
            'FK_role_ID' => 3,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'procurement@gmail.com',
            'FK_role_ID' => 4,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'budget@gmail.com',
            'FK_role_ID' => 5,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'accounting@gmail.com',
            'FK_role_ID' => 6,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'mms@gmail.com',
            'FK_role_ID' => 7,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'kunting@gmail.com',
            'FK_role_ID' => 8,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'finance@gmail.com',
            'FK_role_ID' => 9,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);

        User::create([
            'email' => 'yara@gmail.com',
            'FK_role_ID' => 10,
            'restrict' => 0,
            'password' => Hash::make('CIIS2022'),
        ]);
    }
}
