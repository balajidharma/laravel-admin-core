<?php

namespace BalajiDharma\LaravelAdminCore\Actions\User;

use App\Models\User;
use BalajiDharma\LaravelAdminCore\Data\User\UserCreateData;

class UserCreateAction
{
    public function handle(UserCreateData $data): User
    {
        $user = User::create([
            'name' => $data->getName(),
            'username' => $data->getUsername(),
            'email' => $data->getEamil(),
            'password' => $data->getHashPassword(),
        ]);

        $user->assignRole($data->getRoles());

        syncAdminTags($user, $data->getAdminTags());

        return $user;
    }
}
