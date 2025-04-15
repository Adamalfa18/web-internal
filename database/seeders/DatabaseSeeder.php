<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Alec Thompson',
            'user_role_id' => 1,
            'email' => 'admin@corporateui.com',
            'password' => Hash::make('secret'),
            'about' => "Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).",
        ]);

        UserRole::create([
            'role' => 'admin_dev'
        ]);
        UserRole::create([
            'role' => 'admin'
        ]);
        UserRole::create([
            'role' => 'head_adv'
        ]);
        UserRole::create([
            'role' => 'senior_adv'
        ]);
        UserRole::create([
            'role' => 'staff_adv'
        ]);
        UserRole::create([
            'role' => 'client'
        ]);


        Layanan::create([
            'nama_layanan' => 'Market Booster'
        ]);

        Pegawai::create([
            'nama' => 'dadang'
        ]);
    }
}
