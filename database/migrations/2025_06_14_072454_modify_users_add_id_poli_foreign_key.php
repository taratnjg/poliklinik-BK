<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika kolom poli lama ada, hapus dulu (sesuaikan nama kolom jika berbeda)
            if (Schema::hasColumn('users', 'poli')) {
                $table->dropColumn('poli');
            }

            // Tambah kolom foreign key id_poli
            $table->unsignedBigInteger('id_poli')->nullable()->after('role');

            $table->foreign('id_poli')
                ->references('id')
                ->on('poli')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['id_poli']);
            // Drop kolom id_poli
            $table->dropColumn('id_poli');

            // Bisa ditambahkan kembali kolom poli lama jika perlu
            $table->string('poli')->nullable()->after('role');
        });
    }
};
