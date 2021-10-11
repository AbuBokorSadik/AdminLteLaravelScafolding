<?php

namespace App\Http\Controllers\Exports;

use App\Exports\AdminPanel\CategoryExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function export(Request $request, $category_ids)
    {
        if (!json_decode($category_ids)) {
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        $categories = Category::whereIn('id', json_decode($category_ids))
            ->select('name', 'alias', 'status', 'created_at', 'updated_at')
            ->get();
        return Excel::download(new CategoryExport($categories), 'category-sheet.xlsx');
    }
}
