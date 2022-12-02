<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pembelian', function (Blueprint $table) {
            $table->increments('id_pembelian');
            $table->unsignedInteger('id_supplier');
            $table->integer('total_item');
            $table->double('total_harga');
            $table->integer('diskon');
            $table->double('bayar');
            $table->double('nominal');
            $table->double('tgl_pembelian');
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
        Schema::dropIfExists('tbl_pembelian');
    }
}
