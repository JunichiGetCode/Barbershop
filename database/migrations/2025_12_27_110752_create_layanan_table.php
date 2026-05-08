<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel 'layanans' di database.
     */
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama'); // Kolom nama layanan
            $table->integer('harga'); // Kolom harga (gunakan integer untuk Rupiah)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};