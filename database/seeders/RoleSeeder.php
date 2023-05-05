<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Role::truncate();

        //index 1
        Role::create([
            'name' => "Super Admin",
            'description' => 'IT Administrator of The System',
            'code' => 'JOHXW'
        ]);
        
        //index 2
        Role::create([
            'name' => "Admin",
            'description' => 'Sub IT Administrator of The System',
            'code' => 'JOHXW1'
        ]);

        //index 3
        Role::create([
            'name' => "Department",
            'description' => 'End User of the system, users of hospital department.',
            'code' => 'JOHXW2'
        ]);

        //index 4
        Role::create([
            'name' => "Procurement",
            'description' => 'User under Procurement Department.',
            'code' => 'JOHXW3'
        ]);

        //index 5
        Role::create([
            'name' => "Budget",
            'description' => 'User on Budget department.',
            'code' => 'JOHXW4'
        ]);

        //index 6
        Role::create([
            'name' => "Accounting",
            'description' => 'User on Accounting department.',
            'code' => 'JOHXW5'
        ]);

        //index 7
        Role::create([
            'name' => "MMS",
            'description' => 'User on MMS department.',
            'code' => 'JOHXW6'
        ]);

        //index 8
        Role::create([
            'name' => "OMCC",
            'description' => 'User on OMCC office.',
            'code' => 'JOHXW7'
        ]);

        //index 9
        Role::create([
            'name' => "Finance",
            'description' => 'User on Finance office.',
            'code' => 'JOHXW7'
        ]);

        //index 10
        Role::create([
            'name' => "Dept Head",
            'description' => 'Department Head User.',
            'code' => 'JOHXW7'
        ]);
    }
}
