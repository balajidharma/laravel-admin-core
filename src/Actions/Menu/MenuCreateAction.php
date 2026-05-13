<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Menu;

use BalajiDharma\LaravelAdminCore\Data\Menu\MenuCreateData;
use BalajiDharma\LaravelMenu\Models\Menu;

class MenuCreateAction
{
    public function handle(MenuCreateData $data): Menu
    {
        $menu = Menu::create([
            'name' => $data->getName(),
            'machine_name' => $data->getMachineName(),
            'description' => $data->getDescription(),
        ]);

        syncAdminTags($menu, $data->getAdminTags());

        return $menu;
    }
}
