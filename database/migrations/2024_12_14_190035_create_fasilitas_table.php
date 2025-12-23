<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('camp_fasilitas', function (Blueprint $table) {
            $table->id(); // ID fasilitas
            $table->foreignId('camp_id')->constrained('camp_grounds')->onDelete('cascade'); // Relasi dengan tabel camp_ground
            $table->string('jenis_fasilitas'); // Jenis fasilitas (toilet, parkir, dsb.)
            $table->text('deskripsi'); // Deskripsi tambahan
            $table->timestamps(); // Created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
