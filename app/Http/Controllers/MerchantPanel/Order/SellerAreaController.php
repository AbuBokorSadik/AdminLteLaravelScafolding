<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class SellerAreaController extends Controller
{
    public function getAreas($seller_id)
    {
        try {
            $areas = Area::where([
                'created_by_id' => $seller_id,
            ])
                ->pluck('name', 'id');

            $viewContent =  view('admin.pages.merchantPanel.order.sellerAreaSelectDom', compact('areas'))->render();

            // echo "<pre>";
            // print_r($areas->toArray());
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
