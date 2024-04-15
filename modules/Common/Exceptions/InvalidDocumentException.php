<?php


namespace Modules\Common\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Common\Responses\ApiExceptionResponse;

class InvalidDocumentException extends ApiExceptionResponse
{
    public function __construct()
    {
        parent::__construct(
            'The document provided is invalid or could not be recognized as a valid document for OCR processing.', 
            Response::HTTP_BAD_REQUEST
        );
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $this->message,
        ], $this->code);
    }
}