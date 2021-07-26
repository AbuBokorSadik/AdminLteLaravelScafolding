<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function create(Request $request);

    public function findByEmail($email);

    public function isAuthenticate(Request $request);

}