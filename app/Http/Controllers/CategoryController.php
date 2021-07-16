<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
// public function index(Request $request)
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['galleries'])->paginate(32);

        return view('pages.category',[
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();//kalau kategori ada
        $products = Product::where('categories_id', $category->id)->paginate($request->input('limit', 12));

        return view('pages.category',[
            'categories' => $categories,
            'category' => $category,
            'products' => $products
        ]);
    }
}
