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
        $data = $request->all();
        return $this->create($data);
        
    }

   protected function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
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