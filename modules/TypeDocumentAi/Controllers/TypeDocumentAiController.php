<?php

namespace Modules\TypeDocumentAi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\DTOs\DocumentAiDTO;
use Modules\Common\Responses\ApiSuccessResponse;
use Modules\TypeDocumentAi\Actions\GetType;
use Modules\TypeDocumentAi\Resources\TypeResource;

class TypeDocumentAiController extends Controller
{
    public function getType(Request $request, GetType $action): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new TypeResource($action->handle(DocumentAiDTO::fromRequest($request)))
        );
    }
}