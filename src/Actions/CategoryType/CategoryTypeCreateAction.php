<?php

namespace BalajiDharma\LaravelAdminCore\Actions\CategoryType;

use BalajiDharma\LaravelAdminCore\Data\CategoryType\CategoryTypeCreateData;
use BalajiDharma\LaravelCategory\Models\CategoryType;

class CategoryTypeCreateAction
{
    public function handle(CategoryTypeCreateData $data): CategoryType
    {
        $categoryType = CategoryType::create([
            'name' => $data->getName(),
            'machine_name' => $data->getMachineName(),
            'description' => $data->getDescription(),
            'is_flat' => $data->getIsFlat(),
        ]);

        syncAdminTags($categoryType, $data->getAdminTags());

        return $categoryType;
    }
}
