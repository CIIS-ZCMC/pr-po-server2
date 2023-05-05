<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserDepartment;
use Illuminate\Support\Facades\DB;

class UserDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        UserDepartment::truncate();

        UserDepartment::create([
            'FK_user_ID' => 1,
            'FK_department_ID' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 2,
            'FK_department_ID' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 3,
            'FK_department_ID' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 4,
            'FK_department_ID' => 12,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 5,
            'FK_department_ID' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 6,
            'FK_department_ID' => 72,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 7,
            'FK_department_ID' => 163,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 8,
            'FK_department_ID' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserDepartment::create([
            'FK_user_ID' => 10,
            'FK_department_ID' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
