<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\City;
use App\Models\Courier;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;


class CartController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        $provinces = Province::pluck('title', 'province_id');
        $courier = Courier::select('code', 'title')->get();  
        $address=User::with(['province', 'regencies'])->where('id', Auth::user()->id)->first();
        
        return view('pages.cart',[
            'carts' => $carts,
            'provinces' => $provinces,
            'courier' => $courier,
            'address'=>$address
        ]);
    } 

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }
    


    public function success()
    {
        return view('pages.success');
    }

    public function cekongkir(Request $request){
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin,     // ID kota/kabupaten asal
            'destination'   => $request->city_destination,      // ID kota/kabupaten tujuan
            'weight'        => $request->weight,    // berat barang dalam gram
            'courier'       => $request->courier,
        ])->get();
        return json_encode($cost);
    }

    public function selectedongkir(Request $request){
        $ongkir = $request->ongkir;
        return json_encode($ongkir);
    }


    public function increment($id){
        // dd($id);
        $transaction = Cart::find($id);

        $transaction->update([
            'qty'=>$transaction->qty + 1,
            'total'=>$transaction->product->price*($transaction->qty + 1)
        ]);
        return redirect()->route('cart');
    }
    public function decrement($id){
        // dd($id);
        $transaction = cart::find($id);

        $transaction->update([
            'qty'=>$transaction->qty - 1,
            'total'=>$transaction->product->price*($transaction->qty - 1)
        ]);
        return redirect()->route('cart');
    }

}
