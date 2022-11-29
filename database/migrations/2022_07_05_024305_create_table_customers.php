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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('branch_id', ['020', '062']);
            $table->string('customer_id');
            $table->string('name');
            $table->text('address');
            $table->text('geolocation');
            $table->enum('class', ['Personal', 'Bussiness']);
            $table->string('email');
            $table->string('identity_type')->nullable();
            $table->string('identity_number');
            $table->string('npwp_number')->nullable();
            $table->string('npwp_files')->nullable();
            $table->string('phone_number');
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_npwp')->nullable();
            $table->string('company_npwp_files')->nullable();
            $table->string('company_phone_number')->nullable();
            $table->string('company_employees')->nullable();
            $table->string('survey_id')->nullable();
            $table->string('extend_note')->nullable();
            $table->string('reference_id')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
