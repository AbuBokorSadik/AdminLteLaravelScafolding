<?php

namespace App\Http\Controllers\Exports;

use App\Exports\AdminPanel\MerchantUserExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MerchantUserController extends Controller
{
    public function export(Request $request, $merchant_ids)
    {
        // echo '<pre>';
        // print_r(json_decode($merchant_list));
        // exit();
        if (!json_decode($merchant_ids)) {
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        $merchants = User::whereIn('id', json_decode($merchant_ids))
            ->select('name', 'email', 'mobile', 'address', 'status', 'created_at', 'updated_at')
            ->get();

        // echo '<pre>';
        // print_r($merchants->toArray());
        // exit();
        return Excel::download(new MerchantUserExport($merchants), 'merchent-sheet.xlsx');
        // return (new MerchantUserExport($merchants))->download('merchent-sheet.xlsx');
    }
}
