<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRoleToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $direktur = \App\Models\User::where('name', 'DONI')->first();
        $direktur->assignRole('Direktur');

        $finance = \App\Models\User::where('name', 'DONO')->first();
        $finance->assignRole('Finance');
        
        $staff = \App\Models\User::where('name', 'DONA')->first();
        $staff->assignRole('Staff');

    }
}
