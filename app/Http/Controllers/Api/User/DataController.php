<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job_title;
use App\Models\Management;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;

class DataController extends Controller
{
    public function data() {
        $companies = Company::all();
        $job_titles = Job_title::all();
        $nationalities = Nationality::all();
        $managements = Management::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'companies' => $companies,
                'job_titles' => $job_titles,
                'nationalities' => $nationalities,
                'managements' => $managements
            ]
            ], 200);
    }
}
