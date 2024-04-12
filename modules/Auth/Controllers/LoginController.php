<?php

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Actions\Login;
use Modules\Auth\DTOs\LoginDTO;
use Modules\Auth\Resources\LoginResource;
use Modules\Common\Http\Responses\ApiSuccessResponse;

class LoginController extends Controller 
{
    public function login(Request $request, Login $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new LoginResource($action->handle(LoginDTO::fromRequest($request)))
        );
    }
}