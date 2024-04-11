<?php

namespace Modules\Auth\Actions;

final readonly class DeleteUser
{
    public function __construct(private FetchUser $fetchUser)
    {
    }

    public function handle(string $id): void
    {
        $user = $this->fetchUser->handle($id);
        $user->delete();
    }
}