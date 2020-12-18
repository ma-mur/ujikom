<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nik',50);
            $table->string('nama_lengkap');
            $table->string('institusi');
            $table->integer('id_kompetensi');
            $table->integer('tagihan');
            $table->dateTime('tanggal_pengajuan',0);
            $table->string('bukti_pembayaran',50)->nullable();
            $table->dateTime('waktu_pembayaran',0)->nullable();
            $table->integer('konfirmasi_pembayaran')->nullable();
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
        Schema::dropIfExists('pengajuans');
    }
}
