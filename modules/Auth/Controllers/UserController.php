<?php

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Actions\DeleteUser;
use Modules\Auth\Actions\FetchUser;
use Modules\Auth\Actions\FetchUsersList;
use Modules\Auth\Actions\UpdateUser;
use Modules\Auth\DTOs\UpdateUserDTO;
use Modules\Auth\Resources\UserResource;
use Modules\Common\DTOs\DatatableDTO;
use Modules\Common\Http\Responses\ApiSuccessResponse;
use Modules\Common\Http\Responses\NoContentResponse;

class UserController extends Controller
{
    public function index(Request $request, FetchUsersList $action): JsonResponse
    {
        return UserResource::collection($action->handle(DatatableDTO::fromRequest($request)))->response();
    }

    public function show(string $id, FetchUser $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(new UserResource($action->handle($id)));
    }

    public function update(Request $request, string $id, UpdateUser $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new UserResource($action->handle($id, UpdateUserDTO::fromRequest($request)))
        );
    }

    public function destroy(string $id, DeleteUser $action): NoContentResponse
    {
        $action->handle($id);

        return new NoContentResponse();
    }
}