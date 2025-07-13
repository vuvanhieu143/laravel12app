<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $librarian = Role::firstOrCreate(['name' => 'librarian']);

        // Define permissions
        $create = Permission::firstOrCreate(['name' => 'book.create']);
        $update = Permission::firstOrCreate(['name' => 'book.update']);
        $delete = Permission::firstOrCreate(['name' => 'book.delete']);

        // Assign permissions
        $admin->syncPermissions([$create, $update, $delete]);
        $librarian->syncPermissions([$create, $update]);
    }
}
