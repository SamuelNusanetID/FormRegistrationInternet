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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthMaster',
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSales',
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthCRO',
                'branch_id' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201408',
                'name'      => 'Timmie Maria Gomar Gama',
                'email'     => 'timmie@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthMaster',
                'branch_id' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202141',
                'name'      => 'Sheila Chairunnisa',
                'email'     => 'sheila@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthMaster',
                'branch_id' => '062',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSales',
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSalesManager',
                'branch_id' => '020',
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
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthCRO',
                'branch_id' => '020',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0601726',
                'name'      => 'Ampera Dhindy Relawati',
                'email'     => 'rere@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthCRO',
                'branch_id' => '062',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0201908',
                'name'      => 'Ramon Wiryawan',
                'email'     => 'ramon@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => null,
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'branch_id' => '062',
                'utype'     => 'AuthSalesManager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employee_id' => '0202270',
                'name'      => 'Feba Santisa Sitepu',
                'email'     => 'feba@nusa.net.id',
                'email_verified_at' => Carbon::now(),
                'password'  => bcrypt('12345678'),
                'under_employee_id' => '0201908',
                'profile_pic' => null,
                'isApprovedByAdmin'     => 1,
                'utype'     => 'AuthSales',
                'branch_id' => '062',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
