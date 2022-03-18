<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_id')->constrained('tempat')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama_kategori');
            $table->string('keterangan')->comment('cth: tahun, bulan, hari');
            $table->unsignedInteger('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempat_kategori');
    }
};
