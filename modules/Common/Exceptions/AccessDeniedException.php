<?php


namespace Modules\Common\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Common\Responses\ApiExceptionResponse;

abstract class AccessDeniedException extends ApiExceptionResponse
{
    public function __construct()
    {
        parent::__construct('Access Denied', Response::HTTP_FORBIDDEN);
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $this->message,
        ], $this->code);
    }
}