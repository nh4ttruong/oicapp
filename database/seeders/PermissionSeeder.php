<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view event']);
        Permission::create(['name' => 'view card']);

        Permission::create(['name' => 'edit event']);
        Permission::create(['name' => 'delete event']);
        Permission::create(['name' => 'create event']);
        Permission::create(['name' => 'generate card']);

        Permission::create(['name' => 'add guest']);
        Permission::create(['name' => 'delete guest']);
        Permission::create(['name' => 'import guest']);

        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);

        $role = Role::create(['name' => 'guest']);
        $role->givePermissionTo(['view event', 'view card']);

        $role = Role::create(['name' => 'host']);
        $role->givePermissionTo(['view event', 'view card', 'edit event', 'delete event', 'create event', 'generate card', 'add guest', 'delete guest', 'import guest']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
