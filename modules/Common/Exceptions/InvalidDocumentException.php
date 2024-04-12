<?php


namespace Modules\Common\Exceptions;

use Illuminate\Http\Response;

class InvalidDocumentException extends AbstractException
{
    public function __construct()
    {
        parent::__construct(
            'The document provided is invalid or could not be recognized as a valid document for OCR processing.', 
            Response::HTTP_BAD_REQUEST
        );
    }
}