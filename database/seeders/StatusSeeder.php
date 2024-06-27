<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'new'],
            ['name' => 'buyer cancel'],
            ['name' => 'admin cancel'],
            ['name' => 'done'],
        ];

        DB::table('status')->insert($statuses);
    }
}
