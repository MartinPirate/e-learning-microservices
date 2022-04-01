<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state_name');
            $table->unsignedBigInteger('country_id');
            $table->string('slug');
            $table->tinyInteger('state_code');
            $table->tinyInteger('status');
            $table->tinyInteger('is_default');
            $table->tinyInteger('show_home');
            $table->string('created_at');
            $table->string('updated_at');
            $table->softDeletes();


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
        Schema::dropIfExists('states');
    }
}
