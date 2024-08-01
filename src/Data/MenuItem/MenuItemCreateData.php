<?php

namespace BalajiDharma\LaravelAdminCore\Data\MenuItem;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class MenuItemCreateData extends Data
{
    public function __construct(
        public string $name,
        public string $uri,
        public ?string $description,
        public ?bool $enabled,
        public ?int $parent_id,
        public ?int $weight,
        public ?string $icon,
        public ?array $roles = [],
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => 'required|max:255',
            'uri' => 'required',
            'description' => 'max:255',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUri(): string
    {
        return $this->uri;
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
        return $this->parent_id;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getRoles(): ?array
    {
        return $this->roles ?? [];
    }
}
