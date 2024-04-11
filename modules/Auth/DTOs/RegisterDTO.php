<?php

namespace Modules\Auth\DTOs;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Models\User;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class RegisterDTO extends ValidatedDTO
{
    public string $name;

    public string $email;

    public string $password;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', Rule::unique(User::class)],
            'email' => ['required', 'email', Rule::unique(User::class)],
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed',
            ],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}