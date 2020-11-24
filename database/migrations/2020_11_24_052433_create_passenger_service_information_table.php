<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengerServiceInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passenger_service_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passenger_id')->index();
            $table->unsignedBigInteger('service_data_id')->index();
            $table->string('service_data_value',255);
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->foreign('service_data_id')->references('id')->on('service_data');
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
        Schema::dropIfExists('passenger_service_information');
    }
}
