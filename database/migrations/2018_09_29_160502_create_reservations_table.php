<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('platen_id');
            $table->dateTime('date');
            $table->boolean('is_confirm')->default(false);
            $table->boolean('is_new')->default(true);
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedSmallInteger('count_persons');
            $table->text('comment')->nullable();
            $table->unsignedSmallInteger('notify_id')->nullable();
            $table->boolean('is_delete')->default(false);
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
        Schema::dropIfExists('reservations');
    }
}
