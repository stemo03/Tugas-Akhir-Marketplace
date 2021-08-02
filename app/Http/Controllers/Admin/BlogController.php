<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\BlogRequest;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
      if (request()->ajax()) {
            $query = Blog::query();

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
                                    <a class="dropdown-item" href="' . route('blog.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('blog.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="' . \Storage::url($item->photo) . '" style="max-height: 40px;"/>' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
      }
        return view('pages.admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);//helper dari use Illuminate\Support\Str; bawaan laravel. NAME  itu fied database
        $data['photo'] = $request->file('photo')->store('assets/blog', 'public');
        
        Blog::create($data);

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //$item = Blog::findOrFail($id); kita panggil item=blog(model). fin bla bla, kalo dia ngggak ketemu di nunjukkan error 404

          $item = Blog::findOrFail($id);
          return view('pages.admin.blog.edit',[
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
    public function update(BlogRequest $request, $id)
    {
       $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/blog', 'public');

        $item = Blog::findOrFail($id); 
 
        $item->update($data);

        return redirect()->route('blog.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Blog::findorFail($id);
        $item->delete();

        return redirect()->route('blog.index');
    }
}

