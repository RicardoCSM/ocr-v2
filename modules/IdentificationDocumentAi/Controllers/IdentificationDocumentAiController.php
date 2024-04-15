<?php

namespace Modules\IdentificationDocumentAi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\DTOs\DocumentAiDTO;
use Modules\Common\Responses\ApiSuccessResponse;
use Modules\IdentificationDocumentAi\Actions\GetCnh;
use Modules\IdentificationDocumentAi\Actions\GetCpf;
use Modules\IdentificationDocumentAi\Actions\GetIdentity;
use Modules\IdentificationDocumentAi\Resources\CnhResource;
use Modules\IdentificationDocumentAi\Resources\CpfResource;
use Modules\IdentificationDocumentAi\Resources\IdentityResource;

class IdentificationDocumentAiController extends Controller
{
    public function getCpf(Request $request, GetCpf $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new CpfResource($action->handle(DocumentAiDTO::fromRequest($request)))
        );
    }

    public function getIdentity(Request $request, GetIdentity $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new IdentityResource($action->handle(DocumentAiDTO::fromRequest($request)))
        );
    }

    public function getCnh(Request $request, GetCnh $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new CnhResource($action->handle(DocumentAiDTO::fromRequest($request)))
        );
    }
}