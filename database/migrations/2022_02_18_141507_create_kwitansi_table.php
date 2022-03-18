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
        Schema::create('kwitansi', function (Blueprint $table) {
            $table->id();
            $table->string('no_kwitansi');
            $table->unsignedBigInteger('pedagang_id');
            $table->date('tgl');
            $table->integer('nominal');
            $table->string('terbilang');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('pedagang_id')->references('id')->on('pedagang')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kwitansi');
    }
};
