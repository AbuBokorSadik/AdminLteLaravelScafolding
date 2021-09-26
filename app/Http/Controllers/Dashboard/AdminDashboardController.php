<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function index()
    {
        $title = 'Admin | Dashboard';

        $dashboard_active = 'active';

        return view('admin.pages.dashboard.dashboard', compact('title', 'dashboard_active'));
    }

}
