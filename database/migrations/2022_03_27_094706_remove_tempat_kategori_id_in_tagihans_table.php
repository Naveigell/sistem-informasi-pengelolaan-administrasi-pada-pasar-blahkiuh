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
        Schema::table('tagihans', function (Blueprint $table) {
            $table->dropForeign(['tempat_kategori_id']);
            $table->dropColumn('tempat_kategori_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tagihans', function (Blueprint $table) {
            $table->foreignId('tempat_kategori_id')->nullable()->after('no_tagihan')->constrained('tempat_kategori')->cascadeOnUpdate()->cascadeOnUpdate();
        });
    }
};
