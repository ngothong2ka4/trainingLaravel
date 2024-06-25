<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // Add the master administrator, user id of 1
        $users = [
            [
                
                'name'              => 'Super Admin',
                'email'             => 'super@admin.com',
                'password'          => Hash::make('password'),
                'type'          => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Admin Istrator',
                'email'             => 'admin@admin.com',
                'password'          => Hash::make('password'),
                'type'          => '2',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Manager',
                'email'             => 'manager@manager.com',
                'password'          => Hash::make('password'),
                'type'          => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Executive User',
                'email'             => 'executive@executive.com',
                'password'          => Hash::make('password'),
                'type'          => '2',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'General User',
                'email'             => 'user@user.com',
                'password'          => Hash::make('password'),
                'type'          => '2',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        foreach ($users as $user_data) {
            $user = User::create($user_data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
