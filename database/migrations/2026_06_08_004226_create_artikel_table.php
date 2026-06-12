<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel', function (Blueprint $table) {

            $table->id();

            $table->foreignId('id_penulis')
                ->constrained('penulis')
                ->restrictOnDelete();

            $table->foreignId('id_kategori')
                ->constrained('kategori_artikel')
                ->restrictOnDelete();

            $table->string('judul');
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->date('hari_tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};