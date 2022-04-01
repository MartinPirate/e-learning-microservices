<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {

            $table->dropColumn('name');

            $table->string('slug')->after('id')->nullable();
            $table->string('country_iso_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_order')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('is_default')->nullable();
            $table->tinyInteger('show_home')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
