<?php

namespace App\Http\Controllers\Auth\ChangePassword;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePassword\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChangePasswordController extends Controller
{
    public function showFrom(Request $request)
    {
        $title = 'Change Password';

        return view('admin.pages.auth.changePassword.changePassword', compact('title'));
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::where('email', auth()->user()->email)->first();
            if (!$user) {
                $request->session()->flash('error_alert', 'User not found with the specified email.');
                return redirect()->route('change-password');
            }

            DB::transaction(function () use ($user, $request) {
                $user->password = bcrypt($request->password);
                $user->save();
            });
            $request->session()->flash('success_alert', 'Your Password Update Successfully.');
            return redirect()->route('logout');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('change-password');
        }
    }


}
