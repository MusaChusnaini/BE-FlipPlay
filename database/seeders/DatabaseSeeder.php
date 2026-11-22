<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@flipplay.test',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name'     => 'Siti Aminah',
            'email'    => 'siti@flipplay.test',
            'password' => Hash::make('password123'),
        ]);

        Media::create([
            'title'        => 'Interstellar',
            'type'         => 'movie',
            'genre'        => 'Sci-Fi',
            'release_year' => 2014,
            'description'  => 'Perjalanan antarbintang mencari planet baru bagi umat manusia.',
        ]);

        Media::create([
            'title'        => 'Bohemian Rhapsody',
            'type'         => 'music',
            'genre'        => 'Rock',
            'release_year' => 1975,
            'description'  => 'Lagu ikonik dari band legendaris Queen.',
        ]);

        Media::create([
            'title'        => 'The Witcher 3: Wild Hunt',
            'type'         => 'game',
            'genre'        => 'Action RPG',
            'release_year' => 2015,
            'description'  => 'Petualangan Geralt of Rivia mencari Ciri.',
        ]);
    }
}
