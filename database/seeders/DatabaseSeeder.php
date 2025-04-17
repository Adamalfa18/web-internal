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
            'role' => 'Admin'
        ]);
        UserRole::create([
            'role' => 'C-Level'
        ]);
        UserRole::create([
            'role' => 'Marketing'
        ]);
        UserRole::create([
            'role' => 'Head'
        ]);
        UserRole::create([
            'role' => 'PIC'
        ]);
        UserRole::create([
            'role' => 'Client'
        ]);


        Layanan::create([
            'nama_layanan' => 'Market Booster'
        ]);

        Pegawai::create([
            'nama' => 'dadang'
        ]);
    }
}
