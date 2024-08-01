<?php

namespace BalajiDharma\LaravelAdminCore\Data\CategoryType;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class CategoryTypeCreateData extends Data
{
    public function __construct(
        public string $name,
        public string $machine_name,
        public ?string $description,
        public ?bool $is_flat = false,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => 'required|max:255',
            'machine_name' => 'required|alpha_dash|lowercase|max:64|unique:'.config('category.table_names.category_types', 'category_types').',machine_name',
            'description' => 'max:255',
        ];
    }

    public static function messages(): array
    {
        return [
            'machine_name.lowercase' => 'The machine name must only contain lowercase letters, numbers, dashes and underscores.',
            'machine_name.alpha_dash' => 'The machine name must only contain lowercase letters, numbers, dashes and underscores.',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMachineName(): string
    {
        return $this->machine_name;
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
