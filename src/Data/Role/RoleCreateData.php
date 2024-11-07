<?php

namespace BalajiDharma\LaravelAdminCore\Data\Role;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class RoleCreateData extends BaseData
{
    public function __construct(
        public string $name,
        public ?array $permissions
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.roles', 'roles').',name',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPermissions(): array
    {
        return $this->permissions ?? [];
    }
}
