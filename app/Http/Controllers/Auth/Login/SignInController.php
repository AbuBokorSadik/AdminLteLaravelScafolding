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
        try{
            $isAuthenticated = $this->userRepository->isAuthenticate($request);
            // dd(auth()->user());
            if($isAuthenticated){
                return redirect()->route('dashboard');
                
            }
            return redirect()->back();
        }catch(\Exception $e){
            Log::error($e->getFile(). ' ' . $e->getLine() . ' ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'errorMsg' => 'Something went wrong. Please try again later.'
            ]);

        }
    }
}
