<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Province;
use App\Models\Store;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
class DashboardSettingController extends Controller
{
//  public function index()
    // {
    //     return view('pages.dashboard-transactions');
    // }

    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();
        $category = Category::with('category');

        return view('pages.dashboard-settings',[
            'user' => $user,
            'categories' => $categories,
            'category'=>$category
        ]);
    }

    public function account()
    {
        $user = Auth::user();
        $provinces = Province::pluck('title', 'province_id');
        

        return view('pages.dashboard-account',[
            'user' => $user,
            'provinces'=>$provinces,
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        // dd($data);
        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }


    public function perbarui(Request $request, $redirect)
    {      $id=Auth::user()->id;
        // dd($id);
        $data = $request->except(['_token']);
        // dd($data);
    
        $item = Store::where('user_id',$id);

        $item->update($data);

        return redirect()->route($redirect);
    }
}
