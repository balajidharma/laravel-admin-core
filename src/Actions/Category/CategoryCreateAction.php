<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Category;

use BalajiDharma\LaravelAdminCore\Data\Category\CategoryCreateData;
use BalajiDharma\LaravelCategory\Models\CategoryType;

class CategoryCreateAction
{
    public function handle(CategoryCreateData $data, CategoryType $categoryType)
    {
        $category = $categoryType->categories()->create([
            'name' => $data->getName(),
            'slug' => $data->getSlug(),
            'description' => $data->getDescription(),
            'enabled' => $data->getIsEnabled(),
            'parent_id' => $data->getParentId(),
            'weight' => $data->getWeight(),
        ]);

        syncAdminTags($category, $data->getAdminTags());

        return $category;
    }
}
