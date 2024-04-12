<?php

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Http\Responses\NoContentResponse;

class LogoutController extends Controller
{
    public function logout(Request $request): NoContentResponse
    {
        $user = $request->user();
        $user->tokens()->delete();

        return new NoContentResponse();
    }
}