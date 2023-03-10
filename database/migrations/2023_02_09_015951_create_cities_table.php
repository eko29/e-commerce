<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('city_id');
            $table->string('province_id');
            $table->string('city_name');
            $table->string('postal_code');
            // `city_id` int(11) NOT NULL,
          /*`province_id` int(11) DEFAULT NULL,
          `city_name` varchar(255) DEFAULT NULL,
          `postal_code` char(5) DEFAULT NULL,*/
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
};
