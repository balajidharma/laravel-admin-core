<?php

namespace BalajiDharma\LaravelAdminCore\Actions\MenuItem;

use BalajiDharma\LaravelAdminCore\Data\MenuItem\MenuItemUpdateData;
use BalajiDharma\LaravelMenu\Models\MenuItem;

class MenuItemUpdateAction
{
    public function handle(MenuItemUpdateData $data, MenuItem $menuItem)
    {
        $menuItem->update([
            'name' => $data->getName(),
            'uri' => $data->getUri(),
            'description' => $data->getDescription(),
            'enabled' => $data->getIsEnabled(),
            'parent_id' => $data->getParentId(),
            'weight' => $data->getWeight(),
            'icon' => $data->getIcon(),
        ]);

        $menuItem->syncRoles($data->getRoles());

        return $menuItem;
    }
}
