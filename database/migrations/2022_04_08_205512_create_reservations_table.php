<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->double('total_price');
            $table->unsignedBigInteger('user_id');
            $table->integer('active')->default(0);//0=>pending , 1=> approved , 2=>refused
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('service_id');
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->string('address');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');


            $table->timestamps();
            $table->softDeletes();
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
