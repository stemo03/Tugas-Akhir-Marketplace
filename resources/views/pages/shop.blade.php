@extends('layouts.app')

@section('title')
{{ $product->user->store_name ?? '' }}
@endsection


@section('content')
 <div class="page-content page-home">
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
                
             <center>
                 <img style="max-width: 10%;max-height: 10%" src="https://image.flaticon.com/icons/png/512/869/869636.png" alt="">
               <div>
                    <h1 style="font-family: 'Abril Fatface', cursive;color">{{ $product->user->store_name ?? '' }}</h1>
               </div>
            </center> 
            </div>
            <div class="row">

            <div class="col-12">
                <form >
                        @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- form -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Seller</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                            value="{{ $product->user->name }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group">
                                        <label for="email">Email Seller</label >
                                        <input disabled
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            value="{{ $product->user->email }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group">
                                        <label for="address_one">Alamat Seller</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="address_one"
                                            name="address_one"
                                            value="{{ $product->user->address_one }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group"
                                    >
                                        <label for="address_two">Kecamatan</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="address_two"
                                            name="address_two"
                                            value="{{ $product->user->address_two }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group"
                                    >
                                        <label for="provinces_id">Provinsi</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="provinces_id"
                                            name="provinces_id"
                                            value="{{ $product->user->province->name ?? '' }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="form-group"
                                    >
                                        <label for="regencies_id">Kota</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="regencies_id"
                                            name="regencies_id"
                                            value="{{ $product->user->regencies->name ?? '' }}"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div
                                        class="form-group">
                                        <label for="zip_code">Kode Pos</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="zip_code"
                                            name="zip_code"
                                            value="{{ $product->user->zip_code }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">Negara</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="country"
                                            name="country"
                                            value="{{ $product->user->country }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone_number">No Telepon</label>
                                        <input disabled
                                            type="text"
                                            class="form-control"
                                            id="phone_number"
                                            name="phone_number"
                                            value="{{ $product->user->phone_number }}"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-success">
                                         <a href="https://wa.me/{{ $product->user->phone_number }}?text=Halo%2C%20Saya%20mau%20bertanya%20seputar%20produk%20toko%20anda!" style="text-decorations:none; color:inherit;"> Hubungi Seller </a><i class="fab fa-whatsapp"></i>
                                    </button>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <label for="phone_number"><b>**Catatan</b></label>
                                        <input disabled
                                            type="text"
                                            class="form-control"

                                            value="Jika anda membutuhkan Infomasi lainnya, silahkan hubungi kontak seller yang tertera diatas!!"
                                        />
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
          </div>
        </div>
      </section>


    </div>

@endsection
