<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('poli')->insert([
            [
                'nama' => 'Gigi',
                'deskripsi' => 'Pelayanan kesehatan gigi dan mulut',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Anak',
                'deskripsi' => 'Pelayanan kesehatan khusus anak-anak',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Penyakit Dalam',
                'deskripsi' => 'Pelayanan penyakit dalam dan konsultasi umum',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
