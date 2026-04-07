<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('organizational_structures', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama orang
            $table->string('position'); // Jabatan (Direktur Utama, dll)
            $table->text('description')->nullable(); // Deskripsi tanggung jawab
            $table->integer('level_order'); // Urutan level (1, 2, 3, dst)
            $table->integer('position_order')->default(1); // Urutan dalam level yang sama
            $table->string('background_color')->default('#e3f2fd'); // Warna background card
            $table->string('icon_class')->default('fas fa-user'); // CSS class untuk icon
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizational_structures');
    }
};
