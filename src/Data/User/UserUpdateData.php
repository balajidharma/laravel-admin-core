<?php

namespace BalajiDharma\LaravelAdminCore\Data\User;

use BalajiDharma\LaravelAdminCore\Data\BaseData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UserUpdateData extends BaseData
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $username,
        public ?string $password,
        public ?array $roles
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['sometimes', 'required', 'string', 'max:255', 'unique:users,username,'.request()->route('user')->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.request()->route('user')->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): ?string
    {
        return $this->username;
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
