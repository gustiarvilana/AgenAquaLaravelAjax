<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_penjualan', function (Blueprint $table) {
            $table->increments('id_penjualan');
            $table->unsignedInteger('id_pelanggan');
            $table->string('kode_penjualan');
            $table->double('tgl_trs');
            $table->integer('qty');
            $table->double('harga_total');
            $table->double('bayar');
            $table->string('status_bayar');
            $table->double('sisa_bayar');
            $table->integer('cicil_ke');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_penjualan');
    }
}
