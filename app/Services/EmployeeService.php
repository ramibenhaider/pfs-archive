<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeService
{
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Get paginated list of employees
     */
    public function getPaginatedEmployees(int $perPage = 6): LengthAwarePaginator
    {
        return $this->employeeRepository->getPaginated($perPage);
    }

    /**
     * Find an employee by ID
     */
    public function getEmployeeById(int $id): Employee
    {
        return $this->employeeRepository->findById($id);
    }

    /**
     * Create a new employee based on request data
     */
    public function createEmployee(array $data): Employee
    {
        // Handle is_active explicitly if not present
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        
        return $this->employeeRepository->create($data);
    }

    /**
     * Update an existing employee based on request data
     */
    public function updateEmployee(Employee $employee, array $data): bool
    {
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        $employee->fill($data);
        
        if (!$employee->isDirty()) {
            return false; // Indicates no changes were made
        }

        return $this->employeeRepository->update($employee, $data);
    }

    /**
     * Delete an employee
     */
    public function deleteEmployee(Employee $employee): bool
    {
        return $this->employeeRepository->delete($employee);
    }

    /**
     * Search employees
     */
    public function searchEmployees(string $searchPhrase, int $perPage = 5): LengthAwarePaginator
    {
        return $this->employeeRepository->search($searchPhrase, $perPage);
    }
}
