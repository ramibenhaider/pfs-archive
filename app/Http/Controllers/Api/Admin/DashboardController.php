<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Document_type;
use App\Models\Permission;
use App\Models\User;
use App\Models\Management;
use App\Models\Job_title;
use App\Models\Nationality;

class DashboardController extends Controller
{
    public function permissions () {

        $users = User::with('permissions')->orderByDesc('created_at')->get();
        $permissions = Permission::all();

        return response()->json([
            'status' => 'success',
            'data' => [
                'users' => $users,
                'permissions' => $permissions
            ]
        ]);
    }

    public function fields()
    {
        $companies = Company::orderByDesc('created_at')->get();
        $document_types = Document_type::orderByDesc('created_at')->get();
        $management = Management::orderByDesc('created_at')->get();
        $job_titles = Job_title::orderByDesc('created_at')->get();
        $nationalities = Nationality::orderByDesc('created_at')->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'companies' => $companies,
                'document_types' => $document_types,
                'management' => $management,
                'job_titles' => $job_titles,
                'nationalities' => $nationalities
            ]
        ]);
    }
}
