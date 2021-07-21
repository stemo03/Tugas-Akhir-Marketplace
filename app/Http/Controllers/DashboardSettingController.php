<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Province;
use App\Models\Regency;
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

        return view('pages.dashboard-settings',[
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        $user = Auth::user();
        $province = Province::with(['province']);
        $regencies = Regency::with(['regencies']);

        return view('pages.dashboard-account',[
            'user' => $user,
            'province'=>$province,
            'regencies'=>$regencies
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();

        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }
}
