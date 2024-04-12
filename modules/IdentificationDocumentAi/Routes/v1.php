<?php

use Illuminate\Support\Facades\Route;
use Modules\IdentificationDocumentAi\Controllers\IdentificationDocumentAiController;

Route::prefix('document_ai')->middleware('auth:sanctum')->group(function () {
    Route::post('/cpf', [IdentificationDocumentAiController::class, 'getCpf']);
    Route::post('/identity', [IdentificationDocumentAiController::class, 'getIdentity']);
    Route::post('/cnh', [IdentificationDocumentAiController::class, 'getCnh']);
    // Route::post('/type', [ 'getType']);
});