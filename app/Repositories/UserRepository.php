<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function userRegistration(Request $request)
    {
        return $this->create($request);    
    }

   protected function create(Request $request)
    {
      return User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);
    } 

    public function isAuthenticate(Request $request)
    {
        return Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

    }
    
}