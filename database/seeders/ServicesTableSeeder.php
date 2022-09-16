<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServicesList;

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
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Basic',
                'package_speed' => '30',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Standart',
                'package_speed' => '50',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Standart',
                'package_speed' => '50',
                'package_top' => 'Tahunan',
                'package_price' => '0',
            ],

            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Premium',
                'package_speed' => '100',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Home',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Premium',
                'package_speed' => '100',
                'package_top' => 'Tahunan',
                'package_price' => '0',
            ],

            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Primary',
                'package_speed' => '30',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Primary',
                'package_speed' => '30',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Advanced',
                'package_speed' => '50',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Advanced',
                'package_speed' => '50',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Pro',
                'package_speed' => '100',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Fiber Optic',
                'package_categories' => 'Pro',
                'package_speed' => '100',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Silver',
                'package_speed' => '10',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Silver',
                'package_speed' => '10',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Gold',
                'package_speed' => '20',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Gold',
                'package_speed' => '20',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Diamond',
                'package_speed' => '30',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Broadband Bussiness',
                'package_type' => 'Wireless',
                'package_categories' => 'Diamond',
                'package_speed' => '30',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '75',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '75',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '100',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 4',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '100',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '10',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '15',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '20',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '30',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '40',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '60',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '70',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '80',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '90',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '100',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '150',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '200',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '300',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '400',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '500',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '600',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '700',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '800',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '900',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '1000',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '10',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '15',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '20',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '30',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '40',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '60',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '70',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '80',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '90',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '100',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '150',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '200',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '300',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '400',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '500',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '600',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '700',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '800',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '900',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Fiber Optic',
                'package_categories' => '-',
                'package_speed' => '1000',
                'package_top' => 'Tahunan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '10',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '15',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '20',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '30',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],

            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '40',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
            [
                'package_name' => 'Dedicated 1 : 1',
                'package_type' => 'Wireless',
                'package_categories' => '-',
                'package_speed' => '50',
                'package_top' => 'Bulanan',
                'package_price' => '0'
            ],
        ]);
    }
}
