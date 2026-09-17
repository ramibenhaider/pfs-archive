<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * Get paginated employees
     */
    public function getPaginated(int $perPage = 6): LengthAwarePaginator
    {
        return Employee::orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Search employees by name, job number, or id number
     */
    public function search(string $search, int $perPage = 6): LengthAwarePaginator
    {
        $normalizedSearch = str_replace(['آ', 'أ', 'إ'], 'ا', $search);
        
        return DB::table('employees')
            ->where(function ($query) use ($normalizedSearch, $search) {
                $query->whereRaw("REPLACE(REPLACE(REPLACE(
                            name,'آ','ا'), 'أ','ا'), 'إ','ا') LIKE ?", ["%$normalizedSearch%"])
                    ->orWhere('job_number', 'LIKE', $search . '%')
                    ->orWhere('id_number', 'LIKE', $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Find an employee by ID
     */
    public function findById(int $id): Employee
    {
        return Employee::findOrFail($id);
    }

    /**
     * Create a new employee
     */
    public function create(array $data): Employee
    {
        return Employee::create($data);
    }

    /**
     * Update an employee
     */
    public function update(Employee $employee, array $data): bool
    {
        return $employee->update($data);
    }

    /**
     * Delete an employee
     */
    public function delete(Employee $employee): bool
    {
        return $employee->delete();
    }
}
