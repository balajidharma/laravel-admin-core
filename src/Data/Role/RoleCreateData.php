<?php

namespace BalajiDharma\LaravelAdminCore\Data\Role;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class RoleCreateData extends Data
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
