<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        $listPermission = [];
        $superAdminPermissions = [];
        $adminPermissions = [];
        $editorPermissions = [];

        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                // SuperAdmin
                $superAdminPermissions[] = $permission;
                //Admin
                if (in_array($label, ['Manage Banners', 'Manage Cities', 'Manage Regions', 'Manage Posts', 'Manage Post Categories', 'Manage Tags', 'Manage Galleries', 'Manage Gallery Categories', 'Manage Partners', 'Manage Markets', 'Manage Stalls', 'Manage Stall Categories', 'Manage Promos', 'Manage Metas', 'Manage Flash News', 'Manage Profiles', 'Manage Passwords'])) {
                    $adminPermissions[] = $permission;
                }
                //Editor
                if (in_array($label, ['Manage Posts', 'Manage Post Categories', 'Manage Tags', 'Manage Galleries', 'Manage Gallery Categories', 'Manage Partners', 'Manage Profiles', 'Manage Passwords'])) {
                    $editorPermissions[] = $permission;
                }
            }
        }

        //Insert Permissions
        Permission::insert($listPermission);

        //Insert Roles

        //SuperAdmin
        $superAdmin = Role::create([
            'name' => "SuperAdmin",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //admin
        $admin = Role::create([
            'name' => "Admin",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //Editor
        $editor = Role::create([
            'name' => "Editor",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Role -> Permission
        $superAdmin->givePermissionTo($superAdminPermissions);
        $admin->givePermissionTo($adminPermissions);
        $editor->givePermissionTo($editorPermissions);

        //
        $userSuperAdmin = User::find(1)->assignRole("SuperAdmin");
    }
}
