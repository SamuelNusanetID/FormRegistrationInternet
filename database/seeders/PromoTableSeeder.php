<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PromoList;
use Carbon\Carbon;

class PromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newDataService = new PromoList();
        $newDataService->insert([
            [
                'promo_code' => 'TESTHOME1',
                'package_name' => 'Broadband Home',
                'package_top' => 'Tahunan',
                'discount_cut' => '-',
                'monthly_cut' => '1',
                'monthly_cut_status' => 'Pengurangan',
                'activate_date' => '2022-11-20 00:00:00',
                'expired_date' => '2022-11-25 00:00:00',
                'branch_id' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'promo_code' => 'TESTHOME2',
                'package_name' => 'Broadband Home',
                'package_top' => 'Tahunan',
                'discount_cut' => '-',
                'monthly_cut' => '1',
                'monthly_cut_status' => 'Penambahan',
                'activate_date' => '2022-11-20 00:00:00',
                'expired_date' => '2022-11-25 00:00:00',
                'branch_id' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'promo_code' => 'TESTHOME3',
                'package_name' => 'Broadband Home',
                'package_top' => 'Bulanan',
                'discount_cut' => '-',
                'monthly_cut' => '1',
                'monthly_cut_status' => 'Pengurangan',
                'activate_date' => '2022-11-20 00:00:00',
                'expired_date' => '2022-11-25 00:00:00',
                'branch_id' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
