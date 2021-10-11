<?php

namespace App\Http\Controllers\Exports;

use App\Exports\AdminPanel\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function export(Request $request, $product_ids)
    {
        if (!json_decode($product_ids)) {
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        $products = Product::whereIn('id', json_decode($product_ids))
            ->with(['category'])
            ->get();

        // echo '<pre>';
        // print_r($products->toArray());
        // exit();
        return Excel::download(new ProductExport($products), 'product-sheet.xlsx');
    }
}
