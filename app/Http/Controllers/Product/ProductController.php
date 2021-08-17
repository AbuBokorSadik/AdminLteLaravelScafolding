<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo '<pre>';
        // print_r(explode(' - ', $request->createdAtDateRange));
        // exit();

        $title = 'Product List';
        try {
            $products = Product::with(['category'])
                ->filterByID($request)
                ->filterByName($request)
                ->filterByCategoryID($request)
                ->filterByStatus($request)
                ->filterByUnitPrice($request)
                ->filterByCreatedAtDateRange($request)
                ->where('created_by_id', auth()->user()->id)
                ->paginate(20);

            $categories = Category::where('created_by_id', auth()->user()->id)->pluck('name', 'id');

            $request->flash();

            return view('admin.pages.product.productList', compact('title', 'products', 'categories'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add Product';
        try {
            $categories = Category::where('created_by_id', auth()->user()->id)->pluck('name', 'id');
            return view('admin.pages.product.productAdd', compact('title', 'categories'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try {

            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

            Product::create([
                'created_by_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'unit_price' => $request->unit_price,
                'image' => $filePath,
                'height' => $request->height,
                'width' => $request->width,
                'weight' => $request->weight,
                'size' => $request->size,
                'status' => $request->status,
            ]);

            $request->session()->flash('success_alert', 'Your Product Create Successfully.');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('products.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $title = 'Update  Product';

        try {
            $product = Product::where([
                'id' => $id,
            ])->first();
            $categories = Category::where('created_by_id', auth()->user()->id)->pluck('name', 'id');
            return view('admin.pages.product.productUpdate', compact('title', 'product', 'categories'));
        } catch (\Exception $e) {
            dd('catch');
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $product = Product::find($id);

            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->unit_price = $request->unit_price;
            $product->height = $request->height;
            $product->width = $request->width;
            $product->weight = $request->weight;
            $product->size = $request->size;
            $product->status = $request->status;

            // $fileName = time() . '_' . $request->image->getClientOriginalName();
            // $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            // $product->image = '/storage/' . $filePath;
            $product->save();

            $request->session()->flash('success_alert', 'Your Products Update Successfully.');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            Storage::disk('public')->delete($product->image);
            $product->delete();

            $request->session()->flash('error_alert', $product->name . ' Product Deleted Successfully.');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('products.index');
        }
    }
}
