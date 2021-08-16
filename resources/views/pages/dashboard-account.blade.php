@extends('layouts.dashboard')

@section('title')
Account Setting
@endsection


@section('content')
{{-- Section Konten --}}
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">My Account</h2>
        <p class="dashboard-subtitle">
            Update your current profile
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('dashboard-settings-redirect','dashboard-settings-account') }}" method="POST" enctype="multipart/form-data" id="locations">
                        @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- form -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                            value="{{ $user->name }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group">
                                        <label for="email">Email</label >
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            value="{{ $user->email }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group">
                                        <label for="address_one">Alamat</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="address_one"
                                            name="address_one"
                                            value="{{ $user->address_one }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group"
                                    >
                                        <label for="address_two">Kecamatan</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="address_two"
                                            name="address_two"
                                            value="{{ $user->address_two }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="provinces_id">Provinsi</label>
                                     @if(Auth::user()->provinces_id)
                                        <select name="provinces_id" required class="form-control" id="province">
                                            <option value="">{{ $user->province->title }}</option>
                                            @foreach($provinces as $province => $value)
                                            <option value="{{ $province }}">{{ $value}}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select name="provinces_id" required class="form-control" id="province">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach($provinces as $province => $value)
                                            <option value="{{ $province }}">{{ $value}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="regencies_id">Kota</label>
                                    @if(Auth::user()->regencies_id)
                                        <select name="regencies_id" required class="form-control" id="city">
                                                <option value="">{{ $user->regencies->title }}</option>
                                            </select>
                                        @else
                                        <select name="regencies_id" required class="form-control" id="city">
                                            <option value="">Pilih kabupaten/kota</option>
                                        </select>
                                        @endif
                                    
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div
                                        class="form-group">
                                        <label for="zip_code">Postal Code</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="zip_code"
                                            name="zip_code"
                                            value="{{ $user->zip_code }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="country"
                                            name="country"
                                            value="{{ $user->country }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Telepon <sub>Gunakan kode negara(+628XXXXXX)</sub></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="phone_number"
                                            name="phone_number"
                                            value="{{ $user->phone_number }}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button
                                        type="submit"
                                        class="btn btn btn-success px-5">
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

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
<script>
    $(document).ready(function() {
        $('select[name="provinces_id"]').on('change', function(){
            let provinceId = $(this).val();
            if(provinceId) {
                jQuery.ajax({
                    url:'/province/'+provinceId+'/cities',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="regencies_id"]').empty();
                        $.each(data, function(key,value){
                            $('select[name="regencies_id"]').append('<option value="'+key+'">' + value+ '</option>' );
                        });
                    }, 
                });
            }
            else{
                $('select[name="regencies_id"]').empty();
            }
        });
    });
</script>
@endpush