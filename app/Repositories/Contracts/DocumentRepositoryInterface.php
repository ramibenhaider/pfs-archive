<?php

namespace App\Repositories\Contracts;

interface DocumentRepositoryInterface
{
    public function storeDocument(array $data): Document;
    public function showDocument(int $employeeId): Document;
    public function updateDocument(Document $document, array $data): bool;
    public function deleteDocument(Document $document): bool;
    public function findById(int $id): ?Document;
    public function getDocumentsByTypeForEmployee(int $employeeId, int $documentTypeId, array $columns = ['*']): Collection;
    public function getLatestDocumentByEmployeeAndType(int $employeeId, int $documentTypeId): ?Document;
    public function officePreviewById(int $id): Document;
}
