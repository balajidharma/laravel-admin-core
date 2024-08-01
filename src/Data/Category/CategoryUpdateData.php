<?php

namespace BalajiDharma\LaravelAdminCore\Data\Category;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class CategoryUpdateData extends Data
{
    public function __construct(
        public string $name,
        public ?string $slug,
        public ?string $description,
        public ?bool $enabled,
        public ?int $parentId,
        public ?int $weight = 0,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'max:255',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getIsEnabled(): bool
    {
        return $this->enabled ?? false;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }
}
