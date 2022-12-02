<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_konsumen', function (Blueprint $table) {
            $table->increments('id_konsumen');
            $table->string('kode_konsumen');
            $table->string('nama');
            $table->text('alamat');
            $table->string('telepon');
            $table->unsignedInteger('id_kelurahan');
            $table->unsignedInteger('id_kecamatan');
            $table->unsignedInteger('id_kota');
            $table->string('tipe_pelanggan');
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
        Schema::dropIfExists('tbl_konsumen');
    }
}
