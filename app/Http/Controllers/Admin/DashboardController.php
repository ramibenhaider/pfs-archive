<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Document_type;
use App\Models\User;
use App\Models\Management;
use App\Models\Job_title;
use App\Models\Nationality;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function permissions () {

        $users = User::orderByDesc('created_at')->get();

        return view('admin.permissions', compact('users'));
    }

    public function fields()
    {
        $airlines = Airline::where('id', '>', 1)->orderByDesc('created_at')->get();
        $document_types = Document_type::where('id', '>', 1)->orderByDesc('created_at')->get();
        $management = Management::where('id', '>', 1)->orderByDesc('created_at')->get();
        $job_titles = Job_title::where('id', '>', 1)->orderByDesc('created_at')->get();
        $nationalities = Nationality::where('id', '>', 1)->orderByDesc('created_at')->get();

        return view('admin.fields', compact('airlines', 'document_types', 'job_titles', 'management', 'nationalities'));
    }
}
