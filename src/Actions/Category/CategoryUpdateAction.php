<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Category;

use BalajiDharma\LaravelAdminCore\Data\Category\CategoryUpdateData;
use BalajiDharma\LaravelCategory\Models\Category;
use BalajiDharma\LaravelMediaManager\MediaManager;

class CategoryUpdateAction
{
    protected MediaManager $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    public function handle(CategoryUpdateData $data, Category $category): Category
    {
        $category->update([
            'name' => $data->getName(),
            'slug' => $data->getSlug(),
            'description' => $data->getDescription(),
            'enabled' => $data->getIsEnabled(),
            'parent_id' => $data->getParentId(),
            'weight' => $data->getWeight(),
            'color' => $data->getColor(),
        ]);

        if ($data->getImage()) {
            $media = $category->getMedia('thumbnail')->first();
            $image = $this->mediaManager->createFromSource($data->getImage(), 'default', null, null, $media);
            $category->attachMedia($image, 'thumbnail');
        }
        syncAdminTags($category, $data->getAdminTags());

        return $category;
    }
}
