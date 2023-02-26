<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset Cashed Roles and Permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for articles
        Permission::create(['name' => 'add article']);
        Permission::create(['name' => 'edit my article']);
        Permission::create(['name' => 'edit every article']);
        Permission::create(['name' => 'delete my article']);
        Permission::create(['name' => 'delete every article']);

        // Create permissions for categories
        Permission::create(['name' => 'show category']);
        Permission::create(['name' => 'add category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        // Create permissions for tags
        Permission::create(['name' => 'show tag']);
        Permission::create(['name' => 'add tag']);
        Permission::create(['name' => 'edit tag']);
        Permission::create(['name' => 'delete tag']);

        // Create permissions for comment
        Permission::create(['name' => 'add comment']);
        Permission::create(['name' => 'edit my comment']);
        Permission::create(['name' => 'edit every comment']);
        Permission::create(['name' => 'delete my comment']);
        Permission::create(['name' => 'delete every comment']);

        // Create permissions for roles
        Permission::create(['name' => 'show role']);
        Permission::create(['name' => 'add role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);


        // create role admin and assign permissions (3)
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        // create role publisher and assign permissions (2)
        Role::create(['name' => 'publisher'])
            ->givePermissionTo([
                'add article',
                'edit my article',
                'delete my article',
                'add comment',
                'edit my comment',
                'delete my comment'
            ]);

        // create role user and assign permissions (1)
        Role::create(['name' => 'user'])
            ->givePermissionTo([
                'add comment',
                'edit my comment',
                'delete my comment',
            ]);
    }
}
