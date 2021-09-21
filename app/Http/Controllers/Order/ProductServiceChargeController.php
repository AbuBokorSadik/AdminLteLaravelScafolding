<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\CompanyTaskOrderType;
use Exception;

class ProductServiceChargeController extends Controller
{
    public function getServiceCharge($buyer_id, $order_type_id)
    {
        try {
            $order_type = CompanyTaskOrderType::where([
                'company_id' => $buyer_id,
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
