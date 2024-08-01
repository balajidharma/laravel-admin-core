<?php

namespace BalajiDharma\LaravelAdminCore\Data\Permission;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class PermissionUpdateData extends Data
{
    public function __construct(
        public string $name
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.permissions', 'permissions').',name,'.request()->route('permission')->id,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }
}
