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
        Schema::table('pengeluaran', function (Blueprint $table) {
            $table->foreignId('group_pengeluaran_id')->nullable()->after('id')->constrained('group_pengeluarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('bukti_pengeluaran')->nullable()->change();
            $table->unsignedInteger('jumlah')->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengeluaran', function (Blueprint $table) {
            $table->dropForeign(['group_pengeluaran_id']);
            $table->dropColumn('group_pengeluaran_id');
            $table->string('bukti_pengeluaran')->nullable(false)->change();
            $table->dropColumn('jumlah');
        });
    }
};
