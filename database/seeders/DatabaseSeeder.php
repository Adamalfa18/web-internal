<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\ClientLayanan;
use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\PostMedia;
use App\Models\User;
use App\Models\UserRole;
use App\Models\SocialMedia;
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
            'role' => 'Head-SA'
        ]);
        UserRole::create([
            'role' => 'PIC-SA'
        ]);
        UserRole::create([
            'role' => 'Client'
        ]);
        UserRole::create([
            'role' => 'Head-MB'
        ]);
        UserRole::create([
            'role' => 'PIC-MB'
        ]);
        UserRole::create([
            'role' => 'Head-WEB'
        ]);
        UserRole::create([
            'role' => 'PIC-WEB'
        ]);


        Layanan::create([
            'nama_layanan' => 'Market Booster'
        ]);

        Layanan::create([
            'nama_layanan' => 'Social Media Management'
        ]);

        Layanan::create([
            'nama_layanan' => 'Web Dev'
        ]);

        Pegawai::create([
            'nama' => 'dadang',
            'divisi' => '1'
        ]);

        Pegawai::create([
            'nama' => 'ika',
            'divisi' => '2'
        ]);
        Pegawai::create([
            'nama' => 'Adam',
            'divisi' => '1'
        ]);

        // Client::create([
        //     'nama_client' => 'yuyu',
        //     'nama_brand' => 'uyuy',
        //     'informasi_tambahan' => 'bla',
        //     'alamat' => 'jln',
        //     'email' => 'u@u',
        //     'nama_finance' => 'p',
        //     'telepon_finance' => '090',
        //     'status_client' => 1,
        //     'pegawai_id' => 1,
        //     'pj' => 'Insan',
        //     'date_in' => '2025-04-11'
        // ]);

        // ClientLayanan::create([
        //     'client_id' => 1,
        //     'layanan_id' => 2
        // ]);
    }
}
