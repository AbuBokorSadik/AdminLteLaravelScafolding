<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function userRegistration(Request $request);

    public function isAuthenticate(Request $request);

}