<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
use App\Models\User;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nh4ttruong = User::where('id', 1)->first();
        $nh4ttruong->assignRole([3]);

        $huhu = User::where('id', 2)->first();
        $huhu->assignRole([2]);

        $haha = User::where('id', 3)->first();
        $haha->assignRole([2]);

        $hehe = User::where('id', 4)->first();
        $hehe->assignRole([2]);
    }
}
