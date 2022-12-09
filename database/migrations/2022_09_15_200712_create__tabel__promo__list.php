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
        Schema::create('promo_list', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code');
            $table->string('promo_name');
            $table->enum('branch_id', ['020', '062']);
            $table->string('package_name');
            $table->enum('package_top', ['Bulanan', 'Tahunan']);
            $table->string('discount_cut');
            $table->string('monthly_cut');
            $table->string('monthly_cut_status');
            $table->string('promo_desc');
            $table->enum('promo_status', ['Aktif', 'Tidak Aktif']);
            $table->dateTime('activate_date');
            $table->dateTime('expired_date');
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
        Schema::dropIfExists('promo_list');
    }
};
