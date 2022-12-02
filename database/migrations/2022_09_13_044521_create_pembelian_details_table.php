<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pembelian_detail', function (Blueprint $table) {
            $table->increments('id_pembelian_detail');
            $table->unsignedInteger('id_pembelian');
            $table->string('kode_produk');
            $table->integer('jml_barang');
            $table->double('harga');
            $table->double('total_harga');
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
        Schema::dropIfExists('tbl_pembelian_detail');
    }
}
