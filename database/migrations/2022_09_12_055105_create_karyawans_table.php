<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_karyawan', function (Blueprint $table) {
            $table->increments('id_karyawan');
            $table->string('nama');
            $table->string('nik');
            $table->string('no_ktp');
            $table->string('jabatan');
            $table->text('alamat');
            $table->string('no_hp');
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
        Schema::dropIfExists('tbl_karyawan');
    }
}
