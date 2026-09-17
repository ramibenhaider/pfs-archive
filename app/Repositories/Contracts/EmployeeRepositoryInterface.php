<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    /**
     * Get paginated employees
     */
    public function getPaginated(int $perPage = 6): LengthAwarePaginator;

    /**
     * Search employees by name, job number, or id number
     */
    public function search(string $search, int $perPage = 5): LengthAwarePaginator;

    /**
     * Find an employee by ID
     */
    public function findById(int $id): Employee;

    /**
     * Create a new employee
     */
    public function create(array $data): Employee;

    /**
     * Update an employee
     */
    public function update(Employee $employee, array $data): bool;

    /**
     * Delete an employee
     */
    public function delete(Employee $employee): bool;
}
