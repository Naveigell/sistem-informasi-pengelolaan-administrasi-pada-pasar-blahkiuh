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
        Schema::table('kategori', function (Blueprint $table) {
            $table->unsignedTinyInteger('is_pedagang')->comment('1: if the value is 1, it\'s mean we get pemasukan from pedagang. 0: else we get pemasukan from another.')->after('nama_kategori');
            $table->dropColumn('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn('is_pedagang');
            $table->string('keterangan')->after('nama_kategori' );
        });
    }
};
