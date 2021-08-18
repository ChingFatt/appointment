<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => 'admin']);
        $merchant = Role::create(['name' => 'merchant']);

        $user = \App\Models\User::factory()->create([
            'name'      => 'Super Admin',
            'email'     => 'superadmin@appointment.net',
            'password'  => bcrypt('password'),
        ]);
        $user->assignRole($admin);
    }
}
