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
            <h2 class="dashboard-title"> Blog</h2>
            <p class="dashboard-subtitle">
              Buat Informasi baru
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
                            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Nama Kategori</label>
                                          <input type="text" name="name" id="" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Link Url</label>
                                          <input type="text" name="blog_url" id="" class="form-control" required>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Keterangan</label>
                                          <input type="text" name="desc" id="" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Foto</label>
                                          <input type="file" name="photo" id="" class="form-control" required>
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


