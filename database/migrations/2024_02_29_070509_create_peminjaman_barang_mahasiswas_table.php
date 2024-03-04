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
        Schema::create('peminjaman_barang_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('prodi');
            $table->string('jurusan');
            $table->unsignedBigInteger('user_id')->nullable(); // Menambahkan kolom user_id
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id_barang')->on('barang_lab')->onDelete('cascade');
            $table->integer('jumlah');
            $table->enum('status', ['menunggu_persetujuan_dosen', 'menunggu_persetujuan_teknisi', 'sudah_tervalidasi', 'ditolak']);
            $table->unsignedBigInteger('dosen_approver_id')->nullable();
            $table->unsignedBigInteger('teknisi_lab_approver_id')->nullable();
            $table->timestamp('tanggal_pengajuan')->nullable();
            $table->timestamp('tanggal_pengembalian')->nullable();
            $table->text('catatan')->nullable(); // tambahan field untuk menyimpan catatan penolakan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_barang_mahasiswa');
    }
};
