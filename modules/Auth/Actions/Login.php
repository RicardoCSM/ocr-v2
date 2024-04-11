<?php

declare(strict_types=1);

namespace Modules\Auth\Actions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\DTOs\LoginDTO;
use Modules\Auth\Models\User;

final readonly class Login
{
    public function handle(LoginDTO $dto): array
    {
        if (!Auth::attempt($dto->toArray())) {
            throw new AuthenticationException();
        }

        $user = User::where('email', $dto->email)->first();

        $token = $user->createToken("API TOKEN")->plainTextToken;

        return [
            'token' => $token,
        ];
    }
}