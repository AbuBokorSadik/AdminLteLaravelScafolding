<?php

namespace App\Http\Controllers\Auth\Logout;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {
        try{
            Auth::logout();
            return redirect()->route('login');
        }catch(\Exception $e){
            Log::error($e->getFile(). ' ' . $e->getLine() . ' ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'errorMsg' => 'Something went wrong. Please try again later.'
            ]);
        }
    }
}
