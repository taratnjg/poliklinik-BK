<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JadwalPeriksa;
use App\Models\User;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Ambil satu dokter pertama
    $dokter = User::where('role', 'dokter')->first();

    $jadwals = [
        [
            'id_dokter' => $dokter->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'status' => true,
        ],
        [
            'id_dokter' => $dokter->id,
            'hari' => 'Jumat',
            'jam_mulai' => '14:00:00',
            'jam_selesai' => '17:00:00',
            'status' => false,
        ],
    ];

    foreach ($jadwals as $jadwal) {
        JadwalPeriksa::create($jadwal);
    }
}
}