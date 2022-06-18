<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::create([
            'name' => "Nhat Truong",
            'email' => "truongtbn243@gmail.com",
            'password' => bcrypt('hehehehe'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $user = User::create([
            'name' => "Huhu",
            'email' => "huhu@gmail.com",
            'password' => bcrypt('huhuhuhu'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $user = User::create([
            'name' => "HiHi",
            'email' => "hihi@gmail.com",
            'password' => bcrypt('hihi'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $user = User::create([
            'name' => "HeHe",
            'email' => "hehe@gmail.com",
            'password' => bcrypt('hehe'),
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
