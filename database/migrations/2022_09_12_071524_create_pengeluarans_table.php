<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengeluaran', function (Blueprint $table) {
            $table->increments('id_pengeluaran');
            $table->unsignedInteger('id_transaksi');
            $table->string('nama_pengeluaran');
            $table->string('tipe_pengeluaran');
            $table->double('nominal_pengeluaran');
            $table->double('tgl_pengeluaran');
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
        Schema::dropIfExists('tbl_pengeluaran');
    }
}
