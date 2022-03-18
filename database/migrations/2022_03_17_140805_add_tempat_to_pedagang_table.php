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
        Schema::table('pedagang', function (Blueprint $table) {
            $table->foreignId('tempat_id')->after('id')->default(1)->constrained('tempat')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedagang', function (Blueprint $table) {
            $table->dropForeign('pedagang_tempat_id_foreign');
            $table->dropColumn('tempat_id');
        });
    }
};
