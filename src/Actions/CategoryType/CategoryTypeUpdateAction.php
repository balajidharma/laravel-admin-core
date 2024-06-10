<?php

namespace BalajiDharma\LaravelAdminCore\Actions\CategoryType;

use BalajiDharma\LaravelAdminCore\Data\CategoryType\CategoryTypeUpdateData;
use BalajiDharma\LaravelCategory\Models\CategoryType;

class CategoryTypeUpdateAction
{
    public function handle(CategoryTypeUpdateData $data, CategoryType $categoryType): bool
    {
        return $categoryType->update([
            'name' => $data->getName(),
            'description' => $data->getDescription(),
            'is_flat' => $data->getIsFlat(),
        ]);
    }
}
