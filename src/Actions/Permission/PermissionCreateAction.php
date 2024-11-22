<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Permission;

use App\Models\Permission;
use BalajiDharma\LaravelAdminCore\Data\Permission\PermissionCreateData;

class PermissionCreateAction
{
    public function handle(PermissionCreateData $data): Permission
    {
        $permission = Permission::create([
            'name' => $data->getName(),
        ]);
        syncAdminTags($permission, $data->getAdminTags());

        return $permission;
    }
}
