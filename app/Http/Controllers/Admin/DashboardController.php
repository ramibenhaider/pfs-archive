<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function permissions () {

        $users = User::orderByDesc('created_at')->get();

        return view('admin.permissions', compact('users'));
    }
}
