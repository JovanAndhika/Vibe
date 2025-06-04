<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Music;
use App\Models\Discovery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // default buat akun admin
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
            'date_of_birth' => '2000-01-01'
        ]);

        // default buat akun user
        User::create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'is_admin' => false,
            'date_of_birth' => '2000-01-01'
        ]);

        // default untuk discovery
        Discovery::create([
            'disc_category' => 'none',
        ]);

        // default untuk playlist like
        Playlist::create([
            'name' => 'liked songs',
            'user_id' => 2
        ]);

        // membuat music sementara
        $music_count = 20;
        Music::factory()->count($music_count)->create();

        // membuat playlist sementara
        Playlist::factory()->count(3)->create();
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < rand(5, 10); $j++) {
                Playlist::find($i + 1)->musics()->attach($i + $j + 1);
            }
        }
    }
}
