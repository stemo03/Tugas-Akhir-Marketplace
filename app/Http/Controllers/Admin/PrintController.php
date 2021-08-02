<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class PrintController extends Controller
{
     public function index()
    {   
        $transactions = Transaction::with(['user'])->get();
        $revenue = transaction::sum('total_price') ;
        // $revenue = transaction::where('transaction_status','SUCCESS')->sum('total_price') ;  Kalau jumah trasnsaksi dihitung berdasarkan status 
        $transaction_count = transaction::count();


        return view('pages.admin.transaction.print-transaction',[
            'revenue'=>$revenue,
            'transaction_count'=>$transaction_count,
            'transactions'=>$transactions,
        ]);
    }

}
