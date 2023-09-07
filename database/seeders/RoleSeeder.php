<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Direktur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Finance',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Staff',
                'guard_name' => 'web',
            ],
        ]);
    }
}
