<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_galon', function (Blueprint $table) {
            $table->increments('id_galon');
            $table->unsignedInteger('id_penjualan');
            $table->string('qty_galon_pinjam');
            $table->string('qty_galon_kembali');
            $table->string('qty_galon_sisa');
            $table->double('tgl_kembali');
            $table->string('nama_pengembali');
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
        Schema::dropIfExists('tbl_galon');
    }
}
