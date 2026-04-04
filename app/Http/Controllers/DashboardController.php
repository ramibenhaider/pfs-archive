<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function home()
    {
        $employee = Employee::orderBy('created_at', 'desc')->paginate(6);
        return view('index', compact('employee'));
    }

    public function makeSearch(Request $request)
    {
        $search = $request->search;
        $normalizedSearch = str_replace(['آ', 'أ', 'إ'], 'ا', $search);
        $employee = DB::table('employees')
            ->where(function ($query) use ($normalizedSearch, $search) {
                $query->whereRaw("REPLACE(REPLACE(REPLACE(
                            name,'آ','ا'), 'أ','ا'), 'إ','ا') LIKE ?", ["%$normalizedSearch%"])
                    ->orWhere('job_number', 'LIKE', $search . '%')
                    ->orWhere('id_number', 'LIKE', $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('index', compact('employee'));
    }
}
