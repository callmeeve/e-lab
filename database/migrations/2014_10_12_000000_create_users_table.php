<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['mahasiswa', 'dosen', 'kepala_lab', 'teknisi_lab']);
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}
