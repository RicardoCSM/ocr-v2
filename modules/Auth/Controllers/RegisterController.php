<?php

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Auth\Actions\Register;
use Modules\Auth\DTOs\RegisterDTO;
use Modules\Auth\Resources\UserResource;
use Modules\Common\Http\Responses\ApiSuccessResponse;

class RegisterController extends Controller 
{
    public function register(Request $request, Register $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new UserResource($action->handle(RegisterDTO::fromRequest($request))),
            Response::HTTP_CREATED
        );
    }
}