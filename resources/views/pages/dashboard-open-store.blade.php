@extends('layouts.dashboard')

@section('title')
    Store Setting
@endsection


@section('content')
{{-- Section Konten --}}
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Store Settings</h2>
            <p class="dashboard-subtitle">
                Make store that profitable
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('dashboard-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label>Nama Toko</label>
                                            <input 
                                                v-model="store_name"
                                                id="store_name" 
                                                type="text" 
                                                class="form-control @error('store_name') is-invalid @enderror" 
                                                name="store_name" 
                                                value="{{ old('store_name') }}" 
                                                required 
                                                autocomplete="store_name" 
                                                autofocus
                                            >
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="store_status" value="0">
                                     <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                   
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select
                                            name="categories_id"
                                            id=""
                                            class="form-control"
                                        >
                                            <option value="" disabled>
                                                Select Category
                                            </option>
                                            @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="">KTP</label>
                                    <input type="file" name="id_card" id="" class="form-control">
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select
                                            name="type"
                                            id=""
                                            class="form-control"
                                        >
                                            <option value="" disabled>
                                                Jenis File
                                            </option>
                                            @foreach($values as $value)
                                                <option value="
                                                    @if ($value === 'npwp')
                                                        npwp
                                                    @elseif ($value === 'siup')
                                                        siup
                                                    @elseif ($value === 'situ')
                                                        situ
                                                    @elseif ($value === 'pbb')
                                                        pbb
                                                    @endif
                                                ">
                                                    @if ($value === 'npwp')
                                                        NPWP
                                                    @elseif ($value === 'siup')
                                                        SIUP
                                                    @elseif ($value === 'situ')
                                                        SITU
                                                    @elseif ($value === 'pbb')
                                                        PBB
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">File</label>
                                        <input type="file" name="file" id="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div
                                        class="col text-right "
                                    >
                                        <button
                                            type="submit"
                                            class="btn btn btn-success px-5"
                                        >
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    

@endsection
