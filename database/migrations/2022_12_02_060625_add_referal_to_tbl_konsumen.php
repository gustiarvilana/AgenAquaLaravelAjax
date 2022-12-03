<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferalToTblKonsumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_konsumen', function (Blueprint $table) {
            $table->string('referal')->after('tipe_pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_konsumen', function (Blueprint $table) {
            $table->dropColumn('referal');
        });
    }
}
