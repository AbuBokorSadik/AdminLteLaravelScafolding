<?php

namespace App\Http\Controllers\MerchantPanel\Exports;

use App\Exports\MerchantPanel\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function export(Request $request, $order_ids)
    {
        if (!json_decode($order_ids)) {
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        $orders = Order::whereIn('id', json_decode($order_ids))
            ->with(['orderType', 'orderAssignment.assignedTo', 'orderAssignment.task.assignedTo', 'orderAssignment.orderStatus'])
            ->get();

        // echo '<pre>';
        // print_r($orders->toArray());
        // exit();
        return Excel::download(new OrderExport($orders), 'merchant-order-sheet.xlsx');
    }
}
