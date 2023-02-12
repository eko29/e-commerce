<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->string('nama_produk');
            $table->integer('harga_produk');
            $table->text('deskripsi');
            $table->integer('id_cities');
            $table->char('token');
            $table->string('merek');
            $table->string('garis_Leher');
            $table->string('panjang_Lengan');
            $table->string('acara');
            $table->string('bahan');
            $table->string('model');
            $table->string('u_jumbo');
            $table->string('panjang_celana');
            $table->string('panjang_dress_rok');
            $table->string('musim');
            $table->string('kecil');
            $table->string('negara_asal');
            $table->string('motif');
            $table->string('gaya');
            $table->integer('stok');
            $table->string('diskon', 5);
            $table->string('jenis_atasan');
            $table->string('wide_fit');
            $table->string('tipe_pengikat');
            $table->string('tinggi_sepatu');
            $table->integer('id_kategori');
            $table->integer('weight');
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
        Schema::dropIfExists('produks');
    }
};
