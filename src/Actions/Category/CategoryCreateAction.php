<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Category;

use BalajiDharma\LaravelAdminCore\Data\Category\CategoryCreateData;
use BalajiDharma\LaravelCategory\Models\CategoryType;
use BalajiDharma\LaravelMediaManager\MediaManager;

class CategoryCreateAction
{
    protected MediaManager $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    public function handle(CategoryCreateData $data, CategoryType $categoryType)
    {
        $category = $categoryType->categories()->create([
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
