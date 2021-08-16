<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\BlogRequest;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
      if (request()->ajax()) {
            $query = Store::query();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('store.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('store_status', '@if($store_status == 0) Belum Terverifikasi @elseif($store_status == 1) Terverifikasi @endif')
                ->rawColumns(['action'])
                ->make();
      }
        return view('pages.admin.stores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Store::findOrFail($id);
        
        return view('pages.admin.stores.edit',[
            'item' => $item
        ]);
    }
    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Store::findOrFail($id); 

        if($item->store_status == 1){
            $item->update([
                'store_status' => 0,
            ]);
        }
        elseif($item->store_status == 0){
            $item->update([
                'store_status' => 1,
            ]);
        }


        return redirect()->route('store.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Store::findorFail($id);
        $item->delete();

        return redirect()->route('stores.index');
    }

}

