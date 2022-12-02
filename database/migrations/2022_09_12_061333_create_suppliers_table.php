<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_supplier', function (Blueprint $table) {
            $table->increments('id_supplier');
            $table->string('no_supplier', 6);
            $table->string('nama');
            $table->text('alamat');
            $table->string('telepon');
            $table->unsignedInteger('id_kelurahan');
            $table->unsignedInteger('id_kecamatan');
            $table->unsignedInteger('id_kota');
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
        Schema::dropIfExists('tbl_supplier');
    }
}
