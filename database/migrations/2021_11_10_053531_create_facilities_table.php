<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fshortcode');
            $table->string('facilityname');
            $table->string('oldfacilityname');
            $table->integer('facilitytypeid');
            $table->integer('ownershipmajor');
            $table->integer('ownershipsub');
            $table->string('streetname');
            $table->string('facilityname');
            $table->string('landlineno');
            $table->string('faxnumber');
            $table->string('emailaddress');
            $table->string('officialwebsiteurl');
            $table->string('facilityhead_fname');
            $table->string('facilityhead_lname');
            $table->string('facilityhead_mi');
            $table->string('facilityhead_position');
            $table->string('ownership');
            $table->integer('hosp_licensestatus');
            $table->integer('hosp_servcapability');
            $table->integer('hosp_bedcapacity');
            $table->double('latitude', 8, 2);
            $table->double('longitude', 8, 2);
            $table->string('remarks');
            $table->integer('void');
            $table->integer('reg_psgc');
            $table->integer('prov_psgc');
            $table->integer('muni_psgc');
            $table->integer('brgy_psgc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilities');
    }
}
