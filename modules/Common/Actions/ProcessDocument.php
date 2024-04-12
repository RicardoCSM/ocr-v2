<?php

namespace Modules\Common\Actions;

use Google\Cloud\DocumentAI\V1\Client\DocumentProcessorServiceClient;
use Google\Cloud\DocumentAI\V1\Document;
use Google\Cloud\DocumentAI\V1\ProcessRequest;
use Google\Cloud\DocumentAI\V1\RawDocument;
use Illuminate\Http\JsonResponse;
use Modules\Common\DTOs\DocumentAiDTO;

final readonly class ProcessDocument
{
    public function handle(DocumentAiDTO $dto, string $processorId): Document | JsonResponse
    {
        $projectId = env('DOCUMENT_AI_PROJECT_ID');
        $location = env('DOCUMENT_AI_LOCATION');

        $name = "projects/{$projectId}/locations/{$location}/processors/{$processorId}";
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path() . '/' . env('GOOGLE_APPLICATION_CREDENTIALS'));

        $document = $dto->document;
        $encodedFile = file_get_contents($document->getPathname());
        $fileType = $document->getMimeType();
        $client = new DocumentProcessorServiceClient();

        $rawDocument = new RawDocument();
        $rawDocument->setContent($encodedFile);
        $rawDocument->setMimeType($fileType);

        $testRequest = new ProcessRequest([
            'name' => $name,
            'skip_human_review' => true,
            'raw_document' => $rawDocument
        ]);

        $response = $client->processDocument($testRequest);
        $document = $response->getDocument();
        return $document;
    }
}
