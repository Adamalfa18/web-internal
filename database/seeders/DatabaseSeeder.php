<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
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

        Client::create([
            'nama_client' => 'yuyu',
            'nama_brand' => 'uyuy',
            'informasi_tambahan' => 'bla',
            'alamat' => 'jln',
            'email' => 'u@u',
            'nama_finance' => 'p',
            'telepon_finance' => '090',
            'status_client' => 1,
            'pegawai_id' => 1,
            'pj' => 'Insan',
            'date_in' => '2025-04-11'
        ]);

        SocialMedia::create([
            'content' => 'https://www.logoai.com/uploads/output/2025/03/03/43ec017c8de8a3a36a05c343a452378c.jpg',
            'caption' => 'bla',
            'status' => 0,
            'client_id' => 1
        ]);

        SocialMedia::create([
            'content' => 'https://www.logoai.com/uploads/output/2025/03/03/43ec017c8de8a3a36a05c343a452378c.jpg',
            'caption' => 'bla',
            'status' => 0,
            'client_id' => 1
        ]);

        PostMedia::create([
            'post_id' => 1,
            'post' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/LEGO_logo.svg/1200px-LEGO_logo.svg.png',
        ]);

        PostMedia::create([
            'post_id' => 1,
            'post' => 'https://img.freepik.com/free-vector/bird-colorful-logo-gradient-vector_343694-1365.jpg',
        ]);

        PostMedia::create([
            'post_id' => 1,
            'post' => 'https://www.logoai.com/uploads/output/2025/03/03/a4b5f9ac9d06e5b7b1ed4bb6d9b573a4.jpg',
        ]);
    }
}
