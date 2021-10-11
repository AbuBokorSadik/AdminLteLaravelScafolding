<?php

namespace App\Http\Controllers\Exports;

use App\Exports\AdminPanel\AgentUserExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AgentUserController extends Controller
{
    public function export(Request $request, $agent_ids)
    {
        // echo '<pre>';
        // print_r(json_decode($merchant_list));
        // exit();
        if (!json_decode($agent_ids)) {
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        $agents = User::whereIn('id', json_decode($agent_ids))
        ->select('name', 'email', 'mobile', 'address', 'status', 'created_at', 'updated_at')
        ->get();
        return Excel::download(new AgentUserExport($agents), 'agent-sheet.xlsx');
        // return (new MerchantUserExport($merchants))->download('merchent-sheet.xlsx');
    }
}
