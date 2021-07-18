<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $title = 'Admin | Dashboard';

        return view('admin.pages.dashboard.dashboard', compact('title'));
    }

}
