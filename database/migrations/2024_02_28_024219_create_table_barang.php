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
        Schema::create('table_barang', function (Blueprint $table) {
            Schema::create('barang_lab', function (Blueprint $table) {
                $table->id('id_barang');
                $table->string('nama_barang');
                $table->string('image')->nullable();
                $table->integer('stok')->default(0);
                $table->unsignedBigInteger('id_kategori')->nullable();
                $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            });
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_barang');
        Schema::dropIfExists('barang_lab');
    }
};