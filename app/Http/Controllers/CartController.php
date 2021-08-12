<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\City;
use App\Models\Courier;
use App\Models\Province;
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
        
        return view('pages.cart',[
            'carts' => $carts
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

    // public function rajaongkir(){
    //     $couriers = Courier::pluck('title','code');
    //     $provinces = Province::pluck('title','province_id');
    //     return view ('/',compact('couriers','provinces_id'));

    // }

    // public function getCities($id){
    //     $city = City::where('province_id',$id)->pluck('title','city_id');
    //     return json_encode($city);
    // }

    // public function submit(Request $request){


    //     $cost=RajaOngkir::ongkosKirim([
    //         'origin' => $request->city_origin,
    //         'destination' => $request->city_destination,
    //         'weight' => $request->weight,
    //         'courier' => $request->courier,

    //     ])->get();
    // }


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
