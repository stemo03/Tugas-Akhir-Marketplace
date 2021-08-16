<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\User_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });

       

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->price + $item->transaction->shippinng_price;
        });

        $customer = User::count();
        return view('pages.dashboard',[
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }


//CETAK DATA PENJUALAN TOKO
      public function print(){
       $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->price+30000;
        });

        $customer = User::count();

        return view('pages.print-transaction',[
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }


// FORM DAFTAR TOKO
     public function create()
    {
        $type = DB::select(DB::raw('SHOW COLUMNS FROM stores WHERE Field = "type"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        // passing data ke view
       

        $categories = Category::all();
        return view('pages.dashboard-open-store',[
            'categories' => $categories,
            'values' => $values,
        ]);
    }


    // SIMPAN DATA DAFTAR TOKO
    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_card'] = $request->file('id_card')->store('assets/store', 'public');
        $data['file'] = $request->file('file')->store('assets/store', 'public');
       
        $store = Store::create($data);

        User_roles::create([
                'role_id' => 3,
                'user_id' => Auth::user()->id,
        ]);


        return redirect()->route('register-success');
    }
}
