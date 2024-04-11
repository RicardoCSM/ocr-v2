<?php

namespace Modules\Auth\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\DTOs\UpdateUserDTO;
use Modules\Auth\Models\User;
use Modules\Common\Exceptions\AccessDeniedException;
use Spatie\Permission\Models\Role;

final readonly class UpdateUser
{
    public function __construct(private FetchUser $fetchUser)
    {
    }

    public function handle(string $id, UpdateUserDTO $dto): User
    {
        $authUser = User::find(Auth::id());
        $user = $this->fetchUser->handle($id);
        $updateData = collect($dto->toArray())->filter(fn ($item) => ! is_null($item))->toArray();

        if (!$authUser->hasRole('admin')) {
            unset($updateData['role']);
        }

        if ($authUser->id !== $id && ! $authUser->hasRole('admin')) {
            unset($updateData['email']);
        }

        if ($authUser->id !== $id) {
            unset($updateData['password']);
        }

        $updateData = $this->buildPasswordData($user, $updateData);
        $updateData = $this->changeRole($user, $updateData);
        $user->fill($updateData);
        $user->save();

        return $user;
    }

    private function buildPasswordData(User $user, array $updateData): array
    {
        if (!empty($updateData['password'])) {
            if (! Hash::check($updateData['current_password'], $user->password)) {
                throw new AccessDeniedException();
            }
            $updateData['password'] = Hash::make($updateData['password']);
        }

        unset($updateData['current_password']);

        return $updateData;
    }

    private function changeRole(User $user, array $updateData): array
    {
        if (!empty($updateData['role'])) {
            $role = Role::findByName($updateData['role'], 'web');
            $user->syncRoles($role);
        }

        unset($updateData['role']);

        return $updateData;
    }
}