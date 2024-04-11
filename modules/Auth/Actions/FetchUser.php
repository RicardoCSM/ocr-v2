<?php

namespace Modules\Auth\Actions;

use Modules\Auth\Models\User;

final readonly class FetchUser
{
    public function handle(string $id): User
    {
        return User::findOrFail($id);
    }
}