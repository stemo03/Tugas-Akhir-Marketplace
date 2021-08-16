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
              List of Store
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                            + Tambah User Baru
                            </a> --}}
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

@endsection
@push('addon-script')

<script>
    var datatable = $('#crudTable').DataTable({
        processing:true,
        serverSide:true,
        ordering:true,
        ajax:{
            url:'{!! url()->current() !!}'
        },
        columns:[
            {data:'id',name:'id'},
            {data:'store_name',name:'store_name'},
            {data:'categories_id',name:'categories_id'},
            {data:'store_status',name:'store_status'},
            {
                data:'action',
                name:'action',
                orderable:false,
                searchable:false,
                width:'15%'

            },
            
        ]
    })
</script>
@endpush