<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'employee_id' => '0202240',
                'name'      => 'Samuel Adriel Romaito Manurung',
                'email'     => 'samuel@nusa.net.id',
                'password'  => bcrypt('12345678'),
                'utype'     => 'AuthMaster',
                'isApprovedByAdmin'     => 1,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202233',
                'name'      => 'M. Fikri Pasaribu',
                'email'     => 'fikri@nusa.net.id',
                'password'  => bcrypt('12345678'),
                'utype'     => 'AuthSales',
                'isApprovedByAdmin'     => 1,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202261',
                'name'      => 'Teguh Dana Prayuda',
                'email'     => 'teguhdana@nusa.net.id',
                'password'  => bcrypt('12345678'),
                'utype'     => 'AuthSalesManager',
                'isApprovedByAdmin'     => 1,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201826',
                'name'      => 'Cut Amalia',
                'email'     => 'cutamalia@nusa.net.id',
                'password'  => bcrypt('12345678'),
                'utype'     => 'AuthCRO',
                'isApprovedByAdmin'     => 1,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
