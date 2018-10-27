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
            $table->date('date');
            $table->unsignedSmallInteger('start_hour');
            $table->boolean('is_confirm')->default(false);
            $table->boolean('is_new')->default(true);
            $table->unsignedInteger('client_id');
            $table->unsignedSmallInteger('count_persons');
            $table->unsignedSmallInteger('notify_id');
            $table->softDeletes();
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
