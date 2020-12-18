<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kompetensi',100);
            $table->text('deskripsi');
            $table->integer('harga_stmik');
            $table->integer('harga_umum');
            $table->integer('status_promo');
            $table->integer('promo_stmik')->nullable();
            $table->integer('promo_umum')->nullable();
            $table->string('jenis_kompetensi',100);
            $table->string('masa_berlaku',100)->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('kompetensis');
    }
}
