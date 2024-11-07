<?php

namespace BalajiDharma\LaravelAdminCore\Data\Permission;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class PermissionCreateData extends BaseData
{
    public function __construct(
        public string $name
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.permissions', 'permissions').',name',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }
}
