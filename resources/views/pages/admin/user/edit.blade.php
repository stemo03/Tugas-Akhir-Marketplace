@extends('layouts.admin')
@section('title')
    User
@endsection


@section('content')
{{-- Section Konten --}}
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title"> Edit user</h2>
            <p class="dashboard-subtitle">
              Edit user 
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
                            <form action="{{ route('user.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT') {{--  --}}
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Nama User</label>
                                          <input type="text" name="name" id="" class="form-control" required value="{{ $item->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Email User</label>
                                          <input type="email" name="email" id="" class="form-control" value="{{ $item->email }}">
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Password User</label>
                                          <input type="password" name="password" id="" class="form-control">
                                          <small>Kosongkan jika tidak ingin mengganti password</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="">Roles</label>
                                          <select name="roles" id="" required class="form-control">
                                              <option value="{{ $item->roles }}" selected>{{ $item->roles }}</option>
                                              <option value="ADMIN">Admin</option>
                                              <option value="USER">User</option>
                                          </select>
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


