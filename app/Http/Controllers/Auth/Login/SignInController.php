<?php

namespace App\Http\Controllers\Auth\Login;

use App\Contracts\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSignInRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SignInController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showFrom()
    {
        $title = 'Login to App';

        return view('admin.pages.auth.signin.signin', compact('title'));
    }

    public function authenticateUser(CreateSignInRequest $request)
    {
        try {
            $isAuthenticated = $this->userRepository->isAuthenticate($request);
            if ($isAuthenticated) {
                return redirect()->route('dashboard');
            }

            $request->session()->flash('error_alert', 'These credentials do not match our records.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'These credentials do not match our records.');
            return redirect()->back();
        }
    }
}
