<?php


namespace Modules\Common\Exceptions;

use Illuminate\Http\Response;

class AccessDeniedException extends AbstractException
{
    public function __construct()
    {
        parent::__construct('Access Denied', Response::HTTP_FORBIDDEN);
    }
}