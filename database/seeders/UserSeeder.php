<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Zach Bagley',
                'email' => 'szachbagley@gmail.com',
                'password' => bcrypt(value: 'Fullstack_590r'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
            ];
            User::insert($users);
    }
}
