<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
     public function index()
    {   $customer = User::count();
        $revenue = transaction::sum('total_price') ;
        // $revenue = transaction::where('transaction_status','SUCCESS')->sum('total_price') ;  Kalau jumah trasnsaksi dihitung berdasarkan status 
        $transaction = transaction::count();


        return view('pages.admin.dashboard',[
            'customer'=>$customer,
            'revenue'=>$revenue,
            'transaction'=>$transaction,
        ]);
    }
}
