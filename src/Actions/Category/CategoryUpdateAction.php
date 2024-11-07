<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Category;

use BalajiDharma\LaravelAdminCore\Data\Category\CategoryUpdateData;
use BalajiDharma\LaravelCategory\Models\Category;

class CategoryUpdateAction
{
    public function handle(CategoryUpdateData $data, Category $category): Category
    {
        $category->update([
            'name' => $data->getName(),
            'slug' => $data->getSlug(),
            'description' => $data->getDescription(),
            'enabled' => $data->getIsEnabled(),
            'parent_id' => $data->getParentId(),
            'weight' => $data->getWeight(),
        ]);

        attachCategories($category, $data->getAdminTags());

        return $category;
    }
}
