<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_name');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('country_id');
            $table->string('slug');
            $table->string('zipcode')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('show_home');
            $table->softDeletes();
            $table->string('created_at');
            $table->string('updated_at');

            $table->foreign('state_id')->references('id')->on('states')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('country_id')->references('id')->on('countries')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');


    }
}
