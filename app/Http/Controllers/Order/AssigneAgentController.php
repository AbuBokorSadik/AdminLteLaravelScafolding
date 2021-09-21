<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssigneAgentController extends Controller
{
    public function assigneAgent(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        exit();
    }
}
