<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTabelServiceList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_list', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->enum('package_type', ['Fiber Optic', 'Wireless']);
            $table->string('package_categories');
            $table->string('package_speed');
            $table->string('package_price')->nullable();
            $table->string('retail_package_price')->nullable();
            $table->string('government_package_price')->nullable();
            $table->string('noted_service')->nullable();
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
        Schema::dropIfExists('Services_List');
    }
}
