<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $data;

    public function create(Request $request)
    {
        $this->data = $request->all();
        if(empty($this->findByEmail($this->data['email'])) && $this->checkPassword($this->data))
        {
            return User::create([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'password' => Hash::make($this->data['password'])
              ]);
        }
        
    }

    public function isAuthenticate(Request $request)
    {
        $this->data = $request->all();
        $user = User::where('email',$this->data['email'])->first();
        if(Hash::check($this->data['password'], $user->password)){
            return true;
        }
        return false;

    }

    public function findByEmail($email)
    {
  
        return User::where('email',$email)->get()->toArray();
    }

    protected function checkPassword()
    {
        if($this->data['password'] == $this->data['retype_password']){
            return true;
        }
        return false;
    }
    
}