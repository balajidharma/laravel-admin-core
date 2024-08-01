<?php

namespace BalajiDharma\LaravelAdminCore\Data\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UserCreateData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password,
        public ?array $roles
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEamil(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getHashPassword(): string
    {
        return Hash::make($this->password);
    }

    public function getRoles(): array
    {
        return $this->roles ?? [];
    }
}
