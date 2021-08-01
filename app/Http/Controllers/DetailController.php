<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries','user'])->where('slug', $id)->firstOrFail();
        $comment_count = Comment::where('products_id',$product->id)->with('user')->get();
        $comment = Comment::where('products_id',$product->id)->with('user')->take(10)->latest()->get();
        // dd($comment);
        return view('pages.detail', compact('product','comment','comment_count'));
    }

    public function add(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }

    public function shop(Request $request, $id)
    {
        $product = Product::with(['galleries','user'])->where('slug', $id)->firstOrFail();

        return view('pages.shop', [
            'product' => $product
        ]);
    }
}
