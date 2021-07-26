<?php

namespace App\Http\Controllers\Auth\SignUp;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSignUpRequest;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

class SignUpController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function showFrom()
    {
        $title = 'Signup to App';

        return view('admin.pages.auth.signup.signup', compact('title'));
    }

    public function register(CreateSignUpRequest $request)
    {
        try{
            
            $this->userRepository->create($request);
            return redirect()->route('login');
            
        }catch(\Exception $e){
            Log::error($e->getFile(). ' ' . $e->getLine() . ' ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'errorMsg' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

}
