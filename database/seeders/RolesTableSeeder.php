<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([
    ['name' => 'Admin', 'permissions' => json_encode(['create','update','view','delete'])],
    ['name' => 'Manager', 'permissions' => json_encode(['create','update','view'])],
    ['name' => 'Employee', 'permissions' => json_encode(['view','update'])]
]);

    }
}
