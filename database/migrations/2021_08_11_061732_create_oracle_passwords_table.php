<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOraclePasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oracle_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('host');
            $table->string('port');
            $table->string('sid')->nullable();
            $table->string('service_name')->nullable();
            $table->string('tcps_tcp')->nullable();
            $table->integer('retry_delay')->nullable();
            $table->string('wallet_location')->nullable();
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
        Schema::dropIfExists('oracle_passwords');
    }
}
