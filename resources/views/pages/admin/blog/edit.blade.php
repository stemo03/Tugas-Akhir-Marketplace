                                                                                        @extends('layouts.admin')

@section('title')
    Blog
@endsection


@section('content')
{{-- Section Konten --}}
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Blog</h2>
            <p class="dashboard-subtitle">
              Edit Berita
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('blog.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT') {{--  --}}
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Judul Blog</label>
                                          <input type="text" name="name" id="" class="form-control" required value="{{ $item->name }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Url Blog</label>
                                          <input type="text" name="blog_url" id="" class="form-control" required value="{{ $item->blog_url }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Keterangan</label>
                                          <input type="text" name="desc" id="" class="form-control" required value="{{ $item->desc ?? '' }}">
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Foto</label>
                                          <input type="file" name="photo" id="" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button
                                        type="submit"
                                        class="btn btn-success px-5">
                                        Save Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

@endsection


