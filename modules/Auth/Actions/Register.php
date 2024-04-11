<?php

declare(strict_types=1);

namespace Modules\Auth\Actions;

use Modules\Auth\DTOs\RegisterDTO;
use Modules\Auth\Models\User;
use Spatie\Permission\Models\Role;

final readonly class Register
{
    public function handle(RegisterDTO $dto): User
    {
        $user = $dto->toModel(User::class);
        $user->save();

        $defaultRole = Role::findByName('default', 'web');
        $user->assignRole($defaultRole);

        return $user;
    }
}