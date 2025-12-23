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
        Schema::create('camp_grounds', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('alamat');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('image')->nullable();
            $table->string('fasilitas');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('camp_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_ground_id')->constrained('camp_grounds')->onDelete('cascade');
            $table->integer('rating'); // Kolom untuk menyimpan rating
            $table->text('review')->nullable(); // Kolom untuk menyimpan review (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_grounds');
        Schema::dropIfExists('camp_rating');
    }
};
