<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ketua');
            $table->string('nik');
            $table->string('nomor');
            $table->date('tanggal');
            $table->string('alamat');
            $table->string('desa');
            $table->date('rat');
            $table->integer('aset')->default(0);
            $table->integer('volume')->default(0);
            $table->integer('shu')->default(0);
            $table->enum('keterangan', ['aktif', 'tidak aktif'])->default('aktif');
            $table->foreignId('category_id')->constrained('category_kecamatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatans');
    }
};
