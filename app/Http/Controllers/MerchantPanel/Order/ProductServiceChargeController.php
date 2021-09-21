<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Http\Controllers\Controller;
use App\Models\CompanyTaskOrderType;
use Exception;
use Illuminate\Http\Request;

class ProductServiceChargeController extends Controller
{
    public function getServiceCharge($order_type_id)
    {
        try {
            $order_type = CompanyTaskOrderType::where([
                'company_id' => auth()->user()->id,
                'type_id' => $order_type_id
            ])
                ->first();


            // echo "<pre>";
            // print_r($order_type->toArray());
            // exit();

            return json_encode([
                'code' => 200,
                'messages' => ['success'],
                'data' => $order_type,
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
