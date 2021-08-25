<?php

namespace App\Http\Controllers\Dashboard;

use App\Constant\UserTypeConst;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if(Auth::user()->user_type_id == UserTypeConst::ADMIN){
            return redirect()->route('admin.dashboard');
        }elseif(Auth::user()->user_type_id == UserTypeConst::MERCHANT){
            return redirect()->route('merchant.dashboard');
        }else{
            return redirect()->route('agent.dashboard');
        }
    }

}
