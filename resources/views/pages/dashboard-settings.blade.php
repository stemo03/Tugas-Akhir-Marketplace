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
                    <form action="{{ route('dashboard-settings-store-redirect','dashboard-settings-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group">
                                            <label>Nama Toko</label>
                                            <input type="text" class="form-control" name="store_name" value="{{ $user->store->store_name }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" form-group">
                                            <label>Kategori</label >
                                            <select name="categories_id" class="form-control">
                                            <option value="{{ $user->store->categories_id }}">{{ $user->store->category->name }} (Saat ini)</option>
                                            @foreach ($categories as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Store</label>
                                            <p class="text-muted">
                                                Apakah anda juga ingin membuka 
                                            </p>
                                            <div
                                                class="custom-control custom-radio custom-control-inline">
                                                <input
                                                    type="radio"
                                                    class="custom-control-input"
                                                    name="store_status"
                                                    id="openStoreTrue"
                                                    value="1"
                                                     {{ $user->store->store_status == 1 ? 'checked' : '' }}


                                                />
                                                <label
                                                    for="openStoreTrue"
                                                    class="custom-control-label"
                                                    >Buka</label>
                                            </div>
                                            <div class="
                                                    custom-control
                                                    custom-radio
                                                    custom-control-inline"
                                            >
                                                <input
                                                    type="radio"
                                                    class="custom-control-input"
                                                    name="store_status"
                                                    id="openStoreFalse"
                                                    value="0"
                                                        {{ $user->store->store_status == 0 || $user->store->store_status == NULL ? 'checked' : '' }}
                                                />
                                                <label
                                                    for="openStoreFalse"
                                                    class="custom-control-label"
                                                    >Sementara Tutup</label
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group">
                                            <label>Lengkapi data toko anda!</label>
                                            {{-- <input type="text" class="form-control" name="store_name" value="{{ $user->store->store_name }}"/> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group">
                                            <label>Bank</label>
                                            <input type="text" class="form-control" name="bank" value="{{ $user->store->bank ?? '' }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group">
                                            <label>Nomor Rekening</label>
                                            <input type="text" class="form-control" name="no_rek" value="{{ $user->store->no_rek ?? '' }}"/>
                                        </div>
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
