<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Role;

use App\Models\Role;
use BalajiDharma\LaravelAdminCore\Data\Role\RoleUpdateData;

class RoleUpdateAction
{
    public function handle(RoleUpdateData $data, Role $role): Role
    {
        $role->update(['name' => $data->getName()]);
        $role->syncPermissions($data->getPermissions());
        syncAdminTags($role, $data->getAdminTags());

        return $role;
    }
}
