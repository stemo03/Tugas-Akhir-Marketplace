<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     public function index()
    {   $customer = User::count();
        $blog = Blog::take(6)->get();
        $revenue = transaction::sum('total_price') ;
        // $revenue = transaction::where('transaction_status','SUCCESS')->sum('total_price') ;  Kalau jumah trasnsaksi dihitung berdasarkan status 
        $transaction = transaction::count();


        return view('pages.admin.dashboard',[
            'customer'=>$customer,
            'revenue'=>$revenue,
            'transaction'=>$transaction,
            'blog'=>$blog,
        ]);
    }

    public function email($code)
    {


        $transactiondetail = TransactionDetail::with(['transaction', 'product'])->where('code', $code)->first();

        Mail::to($transactiondetail->product->user->email)->send(new Email($transactiondetail));


        return redirect()->route('transaction.index');
    }
}
