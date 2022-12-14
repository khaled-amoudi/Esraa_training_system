<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard', [
            'users_count' => User::count(),
        ]);
    }
}
