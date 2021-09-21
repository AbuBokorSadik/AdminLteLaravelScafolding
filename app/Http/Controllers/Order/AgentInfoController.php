<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AgentInfoController extends Controller
{
    public function getAgentInfo($agent_id)
    {
        try {
            $agent = User::where([
                'id' => $agent_id,
            ])
                ->first();

            $viewContent =  view('admin.pages.order.agentInformationDom', compact('agent'))->render();

            // echo "<pre>";
            // print_r($agent->toArray());
            // exit();

            return json_encode([
                'code' => 200,
                'messages' => ['success'],
                'data' => $viewContent,
            ]);
        } catch (Exception $e) {
            return json_encode([
                'code' => 500,
                'messages' => ['Failed'],
                'data' => null
            ]);
        }
    }
}
