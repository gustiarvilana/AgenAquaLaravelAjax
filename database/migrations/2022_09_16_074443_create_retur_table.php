<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_retur', function (Blueprint $table) {
            $table->increments('id_retur');
            $table->string('id_supplier');
            $table->unsignedInteger('id_pembelian');
            $table->string('kode_produk');
            $table->double('tgl_retur');
            $table->double('tgl_trs');
            $table->integer('qty');
            $table->double('harga_beli_satuan');
            $table->double('harga_beli_total');
            $table->text('ket');
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
        Schema::dropIfExists('tbl_retur');
    }
}
