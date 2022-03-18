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
            $table->dropForeign('tagihans_jenis_tagihan_id_foreign');
            $table->dropColumn('jenis_tagihan_id');

            $table->foreignId('tempat_kategori_id')->after('id')->default(1)->constrained('tempat_kategori')->cascadeOnDelete()->cascadeOnUpdate();
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
            $table->foreignId('jenis_tagihan_id')->after('id')->default(1)->constrained('jenis_tagihans')->cascadeOnDelete()->cascadeOnUpdate();

            $table->dropForeign('tagihans_tempat_kategori_id_foreign');
            $table->dropColumn('tempat_kategori_id');
        });
    }
};
