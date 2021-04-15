<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id');
            $table->string('created_by');
            $table->string('subject');
            $table->string('content');
            $table->string('start_date');
            $table->string('expiration_date');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
                
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
