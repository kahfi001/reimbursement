<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'          => 'DONI',
                'nip'           => 1234,
                'password'      => bcrypt('123456'),
            ],
            [
                'name'          => 'DONO',
                'nip'           => 1235,
                'password'      => bcrypt('123456'),
            ],
            [
                'name'          => 'DONA',
                'nip'           => 1236,
                'password'      => bcrypt('123456'),
            ],
        ]);
    }
}
