<?php

namespace BalajiDharma\LaravelAdminCore\Actions\MenuItem;

use BalajiDharma\LaravelAdminCore\Data\MenuItem\MenuItemCreateData;
use BalajiDharma\LaravelMenu\Models\Menu;

class MenuItemCreateAction
{
    public function handle(MenuItemCreateData $data, Menu $menu)
    {
        $menuItem = $menu->menuItems()->create([
            'name' => $data->getName(),
            'uri' => $data->getUri(),
            'description' => $data->getDescription(),
            'enabled' => $data->getIsEnabled(),
            'parent_id' => $data->getParentId(),
            'weight' => $data->getWeight(),
            'icon' => $data->getIcon(),
        ]);

        $menuItem->assignRole($data->getRoles());

        syncAdminTags($menuItem, $data->getAdminTags());

        return $menuItem;
    }
}
