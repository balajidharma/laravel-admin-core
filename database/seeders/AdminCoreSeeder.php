<?php

namespace Database\Seeders;

use BalajiDharma\LaravelCategory\Models\CategoryType;
use BalajiDharma\LaravelMenu\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminCoreSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'menu list',
            'menu create',
            'menu edit',
            'menu delete',
            'menu.item list',
            'menu.item create',
            'menu.item edit',
            'menu.item delete',
            'category list',
            'category create',
            'category edit',
            'category delete',
            'category.type list',
            'category.type create',
            'category.type edit',
            'category.type delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('permission list');
        $role1->givePermissionTo('role list');
        $role1->givePermissionTo('user list');
        $role1->givePermissionTo('menu list');
        $role1->givePermissionTo('menu.item list');

        $role2 = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $role2->givePermissionTo($permission);
        }

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);

        // create menu
        $menu = Menu::create([
            'name' => 'Admin',
            'machine_name' => 'admin',
            'description' => 'Admin Menu',
        ]);

        $menu_items = [
            [
                'name' => 'Dashboard',
                'uri' => '/<admin>',
                'enabled' => 1,
                'weight' => 0,
                'icon' => '<svg fill="#000000" viewBox="0 0 24 24" id="dashboard-alt" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path id="primary" d="M2,8V4A2,2,0,0,1,4,2H20a2,2,0,0,1,2,2V8Zm14,2V22h4a2,2,0,0,0,2-2V10Z" style="fill: #000000;"></path><path id="secondary" d="M14,10H2V20a2,2,0,0,0,2,2H14Z" style="fill: #2ca9bc;"></path></g></svg>'
            ],
            [
                'name' => 'Permissions',
                'uri' => '/<admin>/permission',
                'enabled' => 1,
                'weight' => 1,
                'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10H6C4.89543 10 4 10.8954 4 12V38C4 39.1046 4.89543 40 6 40H42C43.1046 40 44 39.1046 44 38V29.5" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10 23H20" stroke="#000000" stroke-width="4" stroke-linecap="round"></path> <path d="M10 31H38" stroke="#000000" stroke-width="4" stroke-linecap="round"></path> <circle cx="34" cy="16" r="6" fill="#2F88FF" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></circle> <path d="M44.0001 28.4187C42.0469 24.6023 38.153 22 33.6682 22C28.2313 22 23.663 25.8243 22.3677 31" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>'
            ],
            [
                'name' => 'Roles',
                'uri' => '/<admin>/role',
                'enabled' => 1,
                'weight' => 2,
                'icon' => '<svg fill="#000000" viewBox="0 0 52 52" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M38.3,27.2A11.4,11.4,0,1,0,49.7,38.6,11.46,11.46,0,0,0,38.3,27.2Zm2,12.4a2.39,2.39,0,0,1-.9-.2l-4.3,4.3a1.39,1.39,0,0,1-.9.4,1,1,0,0,1-.9-.4,1.39,1.39,0,0,1,0-1.9l4.3-4.3a2.92,2.92,0,0,1-.2-.9,3.47,3.47,0,0,1,3.4-3.8,2.39,2.39,0,0,1,.9.2c.2,0,.2.2.1.3l-2,1.9a.28.28,0,0,0,0,.5L41.1,37a.38.38,0,0,0,.6,0l1.9-1.9c.1-.1.4-.1.4.1a3.71,3.71,0,0,1,.2.9A3.57,3.57,0,0,1,40.3,39.6Z"></path> <circle cx="21.7" cy="14.9" r="12.9"></circle> <path d="M25.2,49.8c2.2,0,1-1.5,1-1.5h0a15.44,15.44,0,0,1-3.4-9.7,15,15,0,0,1,1.4-6.4.77.77,0,0,1,.2-.3c.7-1.4-.7-1.5-.7-1.5h0a12.1,12.1,0,0,0-1.9-.1A19.69,19.69,0,0,0,2.4,47.1c0,1,.3,2.8,3.4,2.8H24.9C25.1,49.8,25.1,49.8,25.2,49.8Z"></path> </g></svg>'
            ],
            [
                'name' => 'Users',
                'uri' => '/<admin>/user',
                'enabled' => 1,
                'weight' => 3,
                'icon' => '<svg viewBox="-1 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="user-2" transform="translate(-3 -2)"> <path id="secondary" fill="#2ca9bc" d="M8,15h8a4,4,0,0,1,4,4h0a2,2,0,0,1-2,2H6a2,2,0,0,1-2-2H4a4,4,0,0,1,4-4Z"></path> <path id="primary" d="M20,19h0a2,2,0,0,1-2,2H6a2,2,0,0,1-2-2H4a4,4,0,0,1,4-4h8A4,4,0,0,1,20,19ZM12,3a4,4,0,1,0,4,4A4,4,0,0,0,12,3Z" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </g> </g></svg>'
            ],
            [
                'name' => 'Menus',
                'uri' => '/<admin>/menu',
                'enabled' => 1,
                'weight' => 4,
                'icon' => '<svg fill="#000000" viewBox="0 0 24 24" id="menu-alt-2" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path id="secondary" d="M11,14v7a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V14a1,1,0,0,1,1-1h7A1,1,0,0,1,11,14ZM21,2H14a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V3A1,1,0,0,0,21,2Z" style="fill: #2ca9bc;"></path><path id="primary" d="M11,3v7a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V3A1,1,0,0,1,3,2h7A1,1,0,0,1,11,3ZM21,13H14a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V14A1,1,0,0,0,21,13Z" style="fill: #000000;"></path></g></svg>'
            ],
            [
                'name' => 'Categories',
                'uri' => '/<admin>/category/type',
                'enabled' => 1,
                'weight' => 4,
                'icon' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="6" y="28" width="36" height="14" rx="4" stroke="#000000" stroke-width="4"></rect> <path d="M20 7H10C7.79086 7 6 8.79086 6 11V17C6 19.2091 7.79086 21 10 21H20" stroke="#000000" stroke-width="4" stroke-linecap="round"></path> <circle cx="34" cy="14" r="8" fill="#2F88FF" stroke="#000000" stroke-width="4"></circle> <circle cx="34" cy="14" r="3" fill="white"></circle> </g></svg>'
            ],
        ];

        $menu->menuItems()->createMany($menu_items);

        // create category type
        CategoryType::create([
            'name' => 'Category',
            'machine_name' => 'category',
            'description' => 'Main Category',
        ]);

        CategoryType::create([
            'name' => 'Tag',
            'machine_name' => 'tag',
            'description' => 'Site Tags',
            'is_flat' => true,
        ]);
    }
}
