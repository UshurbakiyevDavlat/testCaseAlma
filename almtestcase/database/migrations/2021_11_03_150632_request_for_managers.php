<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequestForManagers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_for_managers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->string('theme');
            $table->string('message');
            $table->string('client_name');
            $table->string('email_client');
            $table->string('respo');
            $table->timestamp('created_at')->useCurrent()->comment('создано');
            $table->timestamp('updated_at')->useCurrent()->comment('обновлено');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_for_managers');
    }
}
