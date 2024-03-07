<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('reset_token')->nullable()->after('remember_token');
            $table->timestamp('reset_token_expiry')->nullable()->after('reset_token');
        });

        // Set timezone to Indonesia
        date_default_timezone_set('Asia/Jakarta');

        // Update existing timestamps with current timezone
        $now = Carbon::now();
        DB::table('user')->update(['reset_token_expiry' => $now]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['reset_token', 'reset_token_expiry']);
        });
    }
};
