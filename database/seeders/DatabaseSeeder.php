<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ObatSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\JadwalPeriksaSeeder;
use Database\Seeders\JanjiPeriksaSeeder;
use Database\Seeders\PeriksaSeeder;
use Database\Seeders\DetailPeriksaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DokterSeeder::class,
            ObatSeeder::class,
            UserSeeder::class,
            JadwalPeriksaSeeder::class,
            JanjiPeriksaSeeder::class,
            PeriksaSeeder::class,
            DetailPeriksaSeeder::class,
            PoliSeeder::class
        ]);
    }
}