<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_harga_jenis', function (Blueprint $table) {
            $table->increments('id_harga_jenis');
            $table->unsignedInteger('id_tipe');
            $table->string('kode_produk');
            $table->string('nama');
            $table->double('harga');
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
        Schema::dropIfExists('tbl_harga_jenis');
    }
}
