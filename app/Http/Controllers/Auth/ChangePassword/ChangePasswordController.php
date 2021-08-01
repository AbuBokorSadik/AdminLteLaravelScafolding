<?php

namespace App\Http\Controllers\Auth\ChangePassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function showFrom(Request $request)
    {
        $title = 'Forgot Password';

        return view('admin.pages.auth.changePassword.changePassword', compact('title'));
    }
}
