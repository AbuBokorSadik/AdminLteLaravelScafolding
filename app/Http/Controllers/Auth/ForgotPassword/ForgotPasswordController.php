<?php

namespace App\Http\Controllers\Auth\ForgotPassword;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\OtpTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{

    use OtpTrait;
    public function showFrom(Request $request)
    {
        $title = 'Forgot Password';

        return view('admin.pages.auth.forgotPassword.forgotPassword', compact('title'));
    }

    public function otpGenerate(Request $request)
    {
        $title = 'Forgot Password';

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        try {
            $user = User::where('email', $request->email)->first();
            $purpose = 'Password Reset';

            $this->user_otp($user, $purpose, $request);
            return view('admin.pages.auth.forgotPassword.forgotPasswordOtp', compact('title', 'user'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('forgot-password');
        }
    }

    public function otpVerify(Request $request)
    {
        $title = 'Forgot Password';

        $request->validate([
            'otp' => 'required|min:6'
        ]);

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $request->session()->flash('error_alert', 'User not found with the specified email.');
                return redirect()->route('forgot-password');
            }

            $otp = Otp::where('identity', $request->email)->where('otp', $request->otp)
                ->where('status', 0)
                ->where('created_at', '>=', Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s'))
                ->orderBy('created_at', 'DESC')
                ->first();
            if (!$otp) {
                $request->session()->flash('error_alert', 'Invalid or expired otp given.');
                return redirect()->route('forgot-password');
            }

            return view('admin.pages.auth.forgotPassword.recoverPassword', compact('title', 'user', 'otp'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('forgot-password');
        }
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $request->session()->flash('error_alert', 'User not found with the specified email.');
                return redirect()->route('forgot-password');
            }

            $otp = Otp::where('identity', $request->email)->where('otp', $request->otp)
                ->where('status', 0)
                ->where('created_at', '>=', Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s'))
                ->orderBy('created_at', 'DESC')
                ->first();
            if (!$otp) {
                $request->session()->flash('error_alert', 'Invalid or expired otp given.');
                return redirect()->route('forgot-password');
            }

            DB::transaction(function () use ($user, $otp, $request) {
                $otp->status = 1;
                $otp->save();

                $user->password = bcrypt($request->password);
                $user->save();
            });
            $request->session()->flash('success_alert', 'Your Password Reset Successfully.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('forgot-password');
        }
    }
}
