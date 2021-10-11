<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Category List';
        $category_list_active = 'active';
        try {
            $categories = Category::filterByID($request)
                ->filterByName($request)
                ->filterByAlias($request)
                ->filterByStatus($request)
                ->where('created_by_id', auth()->user()->id)
                ->orderBy('id', 'DESC')
                ->paginate(20);

            $request->flash();

            return view('admin.pages.category.categoryList', compact('title', 'category_list_active', 'categories'));
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
        $title = 'Add Category';
        $category_create_active = 'active';
        try {
            return view('admin.pages.category.categoryAdd', compact('title', 'category_create_active'));
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
    public function store(CategoryStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Category::create([
                    'created_by_id' => auth()->user()->id,
                    'name' => $request->name,
                    'alias' => $request->alias,
                    'status' => $request->status,
                ]);
            });

            $request->session()->flash('success_alert', 'Category Created Successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('categories.index');
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
        $title = 'Update Category';

        try {
            $category = Category::where([
                'id' => $id,
            ])->first();

            return view('admin.pages.category.categoryUpdate', compact('title', 'category'));
        } catch (\Exception $e) {
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
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $category = Category::where('id', $id)
                    ->first();

                $category->name = $request->name;
                $category->alias = $request->alias;
                $category->status = $request->status;
                $category->save();

                $products = Product::where('category_id', $category->id)
                    ->get();

                    foreach($products as $product){
                        $product->status = $category->status;
                        $product->save();
                    }
            });

            $request->session()->flash('success_alert', 'Category Updated Successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
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
            $category = Category::find($id);
            $category->delete();
            Product::where('category_id', $id)->delete();
            $request->session()->flash('error_alert', $category->name . ' Category Deleted Successfully.');


            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('categories.index');
        }
    }
}
