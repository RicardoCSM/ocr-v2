<?php

namespace Modules\Common\Responses;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

abstract class ApiExceptionResponse extends Exception implements Responsable
{
    protected $message;
    protected $code;

    public function __construct(string $message, int $code = 400)
    {
        parent::__construct($message);
        $this->message = $message;
        $this->code = $code;
    }

    public abstract function toResponse($request): JsonResponse;
}