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
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthMaster',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202261',
                'name'      => 'Teguh Dana Prayuda',
                'email'     => 'teguhdana@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => '0202169',
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202169',
                'name'      => 'Abdul Azis Laia',
                'email'     => 'abdulazis@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201924',
                'name'      => 'M. Sabrino Raharjo',
                'email'     => 'sabrino@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthCRO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202233',
                'name'      => 'M. Fikri Pasaribu',
                'email'     => 'fikri@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => '0201926',
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201926',
                'name'      => 'Abdul Majid',
                'email'     => 'abdulmajid@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201516',
                'name'      => 'Fani Hardianto',
                'email'     => 'fani@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201318',
                'name'      => 'Jimmy Heryanto',
                'email'     => 'jimmy@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201005',
                'name'      => 'Budiman Silalahi',
                'email'     => 'budiman@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202149',
                'name'      => 'Dita Refieta',
                'email'     => 'ditarefieta@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthCRO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
