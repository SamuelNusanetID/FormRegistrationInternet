<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServicesList;
use Carbon\Carbon;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newDataService = new ServicesList();

        $newDataService->insert([
            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Basic',
                'package_speed' => '30',
                'package_price' => '388500',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Standart',
                'package_speed' => '50',
                'package_price' => '499500',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Premium',
                'package_speed' => '100',
                'package_price' => '888000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Primary',
                'package_speed' => '30',
                'package_price' => '700000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Advanced',
                'package_speed' => '50',
                'package_price' => '1200000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Pro',
                'package_speed' => '100',
                'package_price' => '1980000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Silver',
                'package_speed' => '10',
                'package_price' => '649000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Gold',
                'package_speed' => '20',
                'package_price' => '999000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Diamond',
                'package_speed' => '30',
                'package_price' => '1599000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_price' => '1999000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '75',
                'package_price' => '2899000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '100',
                'package_price' => '3499000',
                'retail_package_price' => null,
                'government_package_price' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '10',
                'package_price' => '0',
                'retail_package_price' => '2070000',
                'government_package_price' => '1800000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '15',
                'package_price' => '0',
                'retail_package_price' => '2800000',
                'government_package_price' => '2500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '20',
                'package_price' => '0',
                'retail_package_price' => '3600000',
                'government_package_price' => '3200000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '30',
                'package_price' => '0',
                'retail_package_price' => '4800000',
                'government_package_price' => '4500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '40',
                'package_price' => '0',
                'retail_package_price' => '6300000',
                'government_package_price' => '5900000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_price' => '0',
                'retail_package_price' => '7000000',
                'government_package_price' => '6500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '60',
                'package_price' => '0',
                'retail_package_price' => '8300000',
                'government_package_price' => '7700000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '70',
                'package_price' => '0',
                'retail_package_price' => '9300000',
                'government_package_price' => '8900000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '80',
                'package_price' => '0',
                'retail_package_price' => '10500000',
                'government_package_price' => '9800000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '90',
                'package_price' => '0',
                'retail_package_price' => '11800000',
                'government_package_price' => '10800000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '100',
                'package_price' => '0',
                'retail_package_price' => '11600000',
                'government_package_price' => '11000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '150',
                'package_price' => '0',
                'retail_package_price' => '17900000',
                'government_package_price' => '16500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '200',
                'package_price' => '0',
                'retail_package_price' => '22700000',
                'government_package_price' => '21000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '300',
                'package_price' => '0',
                'retail_package_price' => '33900000',
                'government_package_price' => '29500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '400',
                'package_price' => '0',
                'retail_package_price' => '42900000',
                'government_package_price' => '37000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '500',
                'package_price' => '0',
                'retail_package_price' => '52000000',
                'government_package_price' => '44000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '600',
                'package_price' => '0',
                'retail_package_price' => '63000000',
                'government_package_price' => '53000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '700',
                'package_price' => '0',
                'retail_package_price' => '67900000',
                'government_package_price' => '61000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '800',
                'package_price' => '0',
                'retail_package_price' => '69700000',
                'government_package_price' => '66000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '900',
                'package_price' => '0',
                'retail_package_price' => '78300000',
                'government_package_price' => '74000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '1000',
                'package_price' => '0',
                'retail_package_price' => '87000000',
                'government_package_price' => '82000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '10',
                'package_price' => '0',
                'retail_package_price' => '2700000',
                'government_package_price' => '2500000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '15',
                'package_price' => '0',
                'retail_package_price' => '3500000',
                'government_package_price' => '3200000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '20',
                'package_price' => '0',
                'retail_package_price' => '4200000',
                'government_package_price' => '3800000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '30',
                'package_price' => '0',
                'retail_package_price' => '5500000',
                'government_package_price' => '5200000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '40',
                'package_price' => '0',
                'retail_package_price' => '6500000',
                'government_package_price' => '6200000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_price' => '0',
                'retail_package_price' => '7700000',
                'government_package_price' => '7200000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
