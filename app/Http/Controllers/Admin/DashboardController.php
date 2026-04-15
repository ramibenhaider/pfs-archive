<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Document_type;
use App\Models\Permission;
use App\Models\User;
use App\Models\Management;
use App\Models\Job_title;
use App\Models\Nationality;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function permissions () {

        $users = User::with('permissions')->orderByDesc('created_at')->get();
        $permissions = Permission::all();

        return view('admin.permissions', compact('users', 'permissions'));
    }

    public function fields()
    {
        $airlines = Airline::orderByDesc('created_at')->get();
        $document_types = Document_type::orderByDesc('created_at')->get();
        $management = Management::orderByDesc('created_at')->get();
        $job_titles = Job_title::orderByDesc('created_at')->get();
        $nationalities = Nationality::orderByDesc('created_at')->get();

        return view('admin.fields', compact('airlines', 'document_types', 'job_titles', 'management', 'nationalities'));
    }
}
