<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Permission;

use App\Models\Permission;
use BalajiDharma\LaravelAdminCore\Data\Permission\PermissionUpdateData;

class PermissionUpdateAction
{
    public function handle(PermissionUpdateData $data, Permission $permission): Permission
    {
        $permission->update([
            'name' => $data->getName(),
        ]);
        syncAdminTags($permission, $data->getAdminTags());

        return $permission;
    }
}
