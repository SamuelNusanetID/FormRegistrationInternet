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
            $table->enum('category', ['Personal', 'Bussiness']);
            $table->string('package_name');
            $table->string('package_price');
            $table->enum('period', ['Bulanan', 'Tahunan']);
            $table->timestamps();
        });

        $insertServiceList = [
            [
                'category' => 'Personal',
                'package_name' => 'Silver',
                'package_price' => '0',
                'period' => 'Bulanan'
            ],
            [
                'category' => 'Personal',
                'package_name' => 'Silver',
                'package_price' => '0',
                'period' => 'Tahunan'
            ],
            [
                'category' => 'Personal',
                'package_name' => 'Gold',
                'package_price' => '0',
                'period' => 'Bulanan'
            ],
            [
                'category' => 'Personal',
                'package_name' => 'Gold',
                'package_price' => '0',
                'period' => 'Tahunan'
            ],
            [
                'category' => 'Personal',
                'package_name' => 'Diamond',
                'package_price' => '0',
                'period' => 'Bulanan'
            ],
            [
                'category' => 'Personal',
                'package_name' => 'Diamond',
                'package_price' => '0',
                'period' => 'Tahunan'
            ],
            [
                'category' => 'Bussiness',
                'package_name' => 'Primary',
                'package_price' => '0',
                'period' => 'Bulanan'
            ],
            [
                'category' => 'Bussiness',
                'package_name' => 'Primary',
                'package_price' => '0',
                'period' => 'Tahunan'
            ],
            [
                'category' => 'Bussiness',
                'package_name' => 'Advance',
                'package_price' => '0',
                'period' => 'Bulanan'
            ],
            [
                'category' => 'Bussiness',
                'package_name' => 'Advance',
                'package_price' => '0',
                'period' => 'Tahunan'
            ],
            [
                'category' => 'Bussiness',
                'package_name' => 'Pro',
                'package_price' => '0',
                'period' => 'Bulanan'
            ],
            [
                'category' => 'Bussiness',
                'package_name' => 'Pro',
                'package_price' => '0',
                'period' => 'Tahunan'
            ]
        ];

        DB::table('services_list')->insert($insertServiceList);
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
