<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipal_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('muni_psgc');
            $table->string('muni_name');
            $table->integer('muni_void');
            $table->integer('prov_psgc');
            $table->integer('reg_psgc');
            $table->integer('districtid');
            $table->integer('zipcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipal_cities');
    }
}
