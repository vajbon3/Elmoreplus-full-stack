<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // who notification is for
            $table->unsignedBigInteger("to")->index();
            $table->foreign("to")->references("id")->on("users")->onDelete("cascade");

            // subject of the notification
            $table->unsignedBigInteger("subject");
            $table->foreign("subject")->references("id")->on("users")->onDelete("cascade");

            // url where notification leads to
            $table->string("url");

            // type of the notification
            $table->unsignedSmallInteger("type")->index();

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
        Schema::dropIfExists('notifications');
    }
}
