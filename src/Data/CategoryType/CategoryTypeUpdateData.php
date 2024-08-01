<?php

namespace BalajiDharma\LaravelAdminCore\Data\CategoryType;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class CategoryTypeUpdateData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?bool $is_flat = false,
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getIsFlat(): ?bool
    {
        return $this->is_flat;
    }
}
