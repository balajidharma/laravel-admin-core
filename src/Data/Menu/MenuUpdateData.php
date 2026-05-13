<?php

namespace BalajiDharma\LaravelAdminCore\Data\Menu;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class MenuUpdateData extends BaseData
{
    public function __construct(
        public string $name,
        public ?string $description,
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
}
