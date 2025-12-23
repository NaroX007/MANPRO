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
        Schema::table('camp_grounds', function (Blueprint $table) {
            $table->dropColumn('fasilitas'); // Menghapus kolom fasilitas
            $table->string('kategori')->after('alamat'); // Menambahkan kolom kategori setelah kolom 'alamat'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
