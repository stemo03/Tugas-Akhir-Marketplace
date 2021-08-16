<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries','user'])->whereHas('user.store', function($query){
                                    $query->where('store_status',1);
                                })->take(8)->latest()->paginate(32);

// dd($products);
        $blog = Blog::take(6)->get();
        // $admin = User::where('roles','ADMIN')->get();
        return view('pages.home',[
            'categories' => $categories,
            'products' => $products,
            'blog'=>$blog,
            // 'admin' => $admin,
        ]);
        
    }

    // $products = Product::with(['galleries','user'])->whereHas('user.store', function($query){
    //                                 $query->where('store_status',1 );
    //                             })->take(8)->latest()->paginate(32);
     

}
