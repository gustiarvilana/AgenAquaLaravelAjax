<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->string('no_sp');
            $table->double('tgl_bayar');
            $table->integer('angsuran_ke');
            $table->double('nominal');
            $table->double('sisa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_pembayaran');
    }
}
