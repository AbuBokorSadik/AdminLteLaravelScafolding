<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\CompanyTaskOrderType;
use Exception;

class OrderTypeController extends Controller
{
    public function getOrderTypes($buyer_id)
    {
        try {
            $orderTypes = CompanyTaskOrderType::where([
                'company_id' => $buyer_id,
            ])
                ->pluck('type','type_id');

            $viewContent =  view('admin.pages.order.orderTypeSelectDom', compact('orderTypes'))->render();

            // echo "<pre>";
            // print_r($orderTypes);
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
