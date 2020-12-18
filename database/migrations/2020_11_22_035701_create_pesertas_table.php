<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nik',50);
            $table->string('nama_lengkap');
            $table->string('institusi');
            $table->integer('id_kompetensi');
            $table->string('ktp',50);
            $table->string('foto',50);
            $table->string('email');
            $table->string('password');
            $table->string('no_telp',20);
            $table->string('tanggal_lahir',50);
            $table->text('alamat');
            $table->dateTime('tanggal_pendaftaran',0);
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
        Schema::dropIfExists('pesertas');
    }
}
