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
              Informasi Pertanian
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('blog.create') }}" class="btn btn-primary mb-3">
                            + Tambah informasi
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" class="display" cellspacing="0" width="100%" style="width: 0px;" id="crudTable">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            {{-- <td>Id</td> --}}
                                            <td>Nama</td>
                                            <td>Foto</td>
                                            <td>Blog Url</td>
                                            <td>Keterangan</td>
                                            {{-- <td>Slug</td> --}}
                                            <td>Aksi</td>
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
            { "data": null,"sortable": false, 
                render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }  
            },
            // {data:'id',name:'id'},
            {data:'name',name:'name'},
            {data:'photo',name:'photo'},
            {data:'blog_url',name:'blog_url'},
            {data:'desc',name:'desc'},
            // {data:'slug',name:'slug'},
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
