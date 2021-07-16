@extends('layouts.admin')

@section('title')
    Product
@endsection


@section('content')
{{-- Section Konten --}}
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title"> product</h2>
            <p class="dashboard-subtitle">
              List of product
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                            + Tambah Product Baru
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <td>Id</td>
                                            <td>Nama</td>
                                            <td>Pemilik</td>
                                            <td>Kategori</td>
                                            <td>Jumlah Stock</td>
                                            <td>Harga</td>
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
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'user.name', name: 'user.name' },
            { data: 'category.name', name: 'category.name' },
            { data: 'quantities', name: 'quantities' },
            { data: 'price', name: 'price' },
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
