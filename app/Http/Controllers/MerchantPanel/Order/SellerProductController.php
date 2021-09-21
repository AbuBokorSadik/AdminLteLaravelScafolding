<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function getProducts($seller_id)
    {
        try {
            $products = Product::where([
                'created_by_id' => $seller_id
            ])
                ->get();

            $viewContent =  view('admin.pages.merchantPanel.order.sellerProductSelectDom', compact('products'))->render();

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
