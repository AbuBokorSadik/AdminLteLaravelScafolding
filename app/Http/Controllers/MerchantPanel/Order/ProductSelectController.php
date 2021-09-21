<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;

class ProductSelectController extends Controller
{
    public function getProduct($product_id)
    {
        try {
            $product = Product::where([
                'id' => $product_id,
            ])
                ->first();

            $viewContent =  view('admin.pages.merchantPanel.order.productSelectDom', compact('product'))->render();

            // echo "<pre>";
            // print_r($viewContent);
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
