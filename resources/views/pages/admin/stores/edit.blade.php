@extends('layouts.admin')

@section('title')
    Store
@endsection


@section('content')
{{-- Section Konten --}}
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title"> Store</h2>
            <p class="dashboard-subtitle">
              Edit Store
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
                            <form action="{{ route('store.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT') {{--  --}}
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Nama Toko</label>
                                          <input type="text"  name="store_name" id="" class="form-control" disabled value="{{ $item->store_name }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Kategori Toko</label>
                                          <input type="text" name="categories_id" id="" class="form-control" disabled value="{{ $item->categories_id }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Status Toko</label>
                                          <input type="text" name="store_status" id="" class="form-control"  value="{{ $item->store_status }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">KTP :</label>
                                           <div class="card" style="width: 18rem;">
                                            <img src="{{  Storage::url($item->id_card) }}" alt="" style="width: 100%">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="">
                                            @if($item->type == 'npwp')
                                                NPWP :
                                            @elseif($item->type == 'siup')
                                                SIUP :
                                            @elseif($item->type == 'situ')
                                                SITU :
                                            @elseif($item->type == 'pbb')
                                                PBB :
                                            @endif
                                          </label>
                                            <div class="card" style="width: 18rem;">
                                            <img src="{{  Storage::url($item->file) }}" alt="" style="width: 100%">
                                            </div>
                                         
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pemilik</label>
                                            <input type="text" name="user_id" id="" class="form-control"  value="{{ $item->user->name }}" disabled>

                                        </div>
                                        <div class="col-md-12">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button
                                        type="submit"
                                        class="btn btn-success px-5">
                                            @if($item->store_status == 1)
                                                Batalkan Verifikasi Toko
                                            @elseif($item->store_status == 0)
                                                Verifikasi
                                            @endif
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


