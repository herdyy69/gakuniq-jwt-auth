<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori;
use App\Models\Sub_kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        Kategori::create([
            'name' => 'laki-laki',
        ]);

        Kategori::create([
            'name' => 'perempuan',
        ]);

        Sub_kategori::create([
            'kategori_id' => 1,
            'sub_kategori' => 'kaos',
        ]);

        Sub_kategori::create([
            'kategori_id' => 2,
            'sub_kategori' => 'baju',
        ]);

        Sub_kategori::create([
            'kategori_id' => 2,
            'sub_kategori' => 'celana',
        ]);

        \App\Models\Produk::factory(5)->create();
    }
}
