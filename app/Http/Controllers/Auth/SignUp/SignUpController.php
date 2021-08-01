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
        try {

            $this->userRepository->userRegistration($request);
            $request->session()->flash('success_alert', 'Successfully user register.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('login');
        }
    }
}
