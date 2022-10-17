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
        ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Fajar',
        //     'email'     => 'fajar@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Cut Amalia',
        //     'email'     => 'cutamalia@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'samuel',
        //     'email'     => 'samuel@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Riris',
        //     'email'     => 'riris@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Syafii',
        //     'email'     => 'syafii@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Jefri',
        //     'email'     => 'jefri@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Ali Putera',
        //     'email'     => 'aliputera@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Timmie',
        //     'email'     => 'timmie@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Sovian',
        //     'email'     => 'sovian@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()


        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Ramon',
        //     'email'     => 'ramon@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Bambang',
        //     'email'     => 'bambang@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Rudi',
        //     'email'     => 'sahrudi@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Budiman',
        //     'email'     => 'budiman@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Fani',
        //     'email'     => 'fani@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Jimmy',
        //     'email'     => 'jimmy@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // User::create([
        //     'employee_id' => '',
        //     'name'      => 'Abdul Majid',
        //     'email'     => 'abdulmajid@nusa.net.id',
        //     'password'  => bcrypt('12345678'),
        //     'utype'     => 'AuthMaster',
        //     'email_verified_at' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()

        // ]);
    }
}
