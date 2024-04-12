<?php

use Illuminate\Support\Facades\Route;
use Modules\TypeDocumentAi\Controllers\TypeDocumentAiController;

Route::prefix('document_ai')->middleware('auth:sanctum')->group(function () {
    Route::post('/type', [TypeDocumentAiController::class, 'getType']);
});