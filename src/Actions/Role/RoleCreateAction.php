<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Role;

use App\Models\Role;
use BalajiDharma\LaravelAdminCore\Data\Role\RoleCreateData;

class RoleCreateAction
{
    public function handle(RoleCreateData $data): Role
    {
        $role = Role::create([
            'name' => $data->getName(),
        ]);

        if (! empty($data->getPermissions())) {
            $role->givePermissionTo($data->getPermissions());
        }

        attachCategories($role, $data->getAdminTags());

        return $role;
    }
}
