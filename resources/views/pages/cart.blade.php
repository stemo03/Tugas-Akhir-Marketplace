@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
<div class="page-content page-cart">
      <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Cart</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-cart">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table class="table table-borderless table-cart">
                <thead>
                  <tr>
                    <td>Image</td>
                    <td>Name &amp; Seller</td>
                    <td>Jumlah Barang</td>
                    <td>Harga Satuan</td>
                    <td>Subtotal Harga</td>
                    <td>Menu</td>
                  </tr>
                </thead>
                    <tbody>
                      @php
                        $totalPrice = 0;
                         $tax=0;
                         $insurance=0;
                         $total=0;
                          $shipping=0;
                           $con = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                      @endphp
                      @if ($con==0)
                        <p style="font-size: 16px;	font-family: 'Knewave', cursive;color:#1abc9c; margin-top: -5px;text-align: center">Keranjangmu Masih Kosong, Ayo Belanja!
                        </p>
                      @else
                        @foreach ($carts as $cart )
                          <tr>
                              <td style="width: 20%">
                                @if ($cart->product->galleries->count())
                                <img
                                  src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                  alt=""
                                  class="cart-image"
                                />
                                @endif
                              </td>
                              <td style="width: 35%">
                                <div class="product-title">{{ $cart->product->name }}</div>
                                <div class="product-subtitle">{{ $cart->product->user->store_name }}</div>
                              </td>

                            <td style="width: 20%;" >
                                <div>
                                  @if ($cart->qty>1)
                                    <form action="{{ route('dec',$cart->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" style="width: 25%; display:inline;">-</button>
                                    </form>
                                  @endif
                                  <input type="text" name="qty" class="form-control qty" style="width: 25%; display:inline;" value="{{ $cart->qty }}"readonly>

                                  <form action="{{ route('in',$cart->id) }}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" style="width: 25%;display:inline;" >+</button>
                                  </form>
                                </div>
                                </td>

                        {{-- Harga Satuan --}}

                              <td style="width: 35%">
                                <div class="product-title" id='price'>Rp. {{ number_format($cart->product->price) }}</div>
                                <div class="product-subtitle">Rupiah</div>
                              </td>

                          {{-- Sub total Harga --}}
                              <td style="width: 20%;">
                                <div class="product-title">Rp. {{ number_format($cart->product->price * $cart->qty ) }}</div>
                                <div class="product-subtitle">Rupiah</div>
                             </td>

                              <td style="width: 20%;">
                                <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                    <button class="btn btn-remove-card" type="submit">
                                      Remove
                                    </button>
                                </form>
                              </td>
                              @php
                                // HITUNG BEDASARKAN JUMLAH 
                                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->sum('qty');
                                $shipping=$carts*30000;
                                $totalPrice += $cart->product->price;
                                $tax=$totalPrice*0.001;
                                
                                if ($totalPrice<500000) {
                                  $insurance=0;
                                }
                                elseif ($totalPrice>=500000 && $totalPrice<=1000000) {
                                  $insurance=10000;
                                }else {
                                  $insurance=$totalPrice*0.01;
                                }
                                $total= $shipping+$totalPrice+$tax+$insurance;
                                
                              @endphp
                        @endforeach
                      @endif
                       
                    </tbody>
              </table>
            </div>
          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-lg-12">
              <hr />
            </div>
            <div class="col-12">
              <h2 class="mb-4">Shipping Details</h2>
            </div>
          </div>
          <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST" >
            @csrf
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <input type="hidden" name="insurance" value="{{ $insurance }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="shipping" value="{{ $shipping }}">
            
              <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address_one">Address 1</label>
                    <input
                      type="text"
                      class="form-control"
                      id="address_one"
                      name="address_one"
                      value="Setrea Duta Cemara"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address_two">Address 2</label>
                    <input
                      type="text"
                      class="form-control"
                      id="address_two"
                      name="address_two"
                      value="Blok b2 no 34"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="provinces_id">Province</label>
                    <select name="provinces_id" id="provinces_id" class="form-control"    
                            v-model="provinces_id" v-if="provinces">
                      <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                    </select>
                    <select v-else class="form-control"></select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="regencies_id">City</label>
                      <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                        <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                      </select>
                    <select v-else class="form-control"></select>
                  </div>
              </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="zip_code">Postal Code</label>
                    <input
                      type="text"
                      class="form-control"
                      id="zip_code"
                      name="zip_code"
                      value="22252"
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
                      value="Indonesia"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone_number">Mobile</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone_number"
                      name="phone_number"
                      value="+62 822 013 1 998"
                    />
                  </div>
                </div>
             </div>

        
              <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-lg-12">
                  <hr />
                </div>
                <div class="col-12">
                  <h2 class="mb-1">Payment Informations</h2>
                </div>
              </div>

              <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-4 col-md-2">
                  <div class="product-title">Rp. {{ number_format($tax ?? 0) }}</div>
                  <div class="product-subtitle">Cauntry Tax</div>
                </div>
                <div class="col-4 col-md-3">
                  <div class="product-title">Rp. {{ number_format($insurance ?? 0) }}</div>
                  <div class="product-subtitle">Product Insurance</div>
                </div>
                <div class="col-4 col-md-2">
                  <div class="product-title">Rp. {{ number_format($shipping ?? 0) }}</div>
                  <div class="product-subtitle">Ship To Jakarta</div>
                </div>
                <div class="col-4 col-md-2">
                  <div class="product-title text-success">Rp. {{ number_format($total ?? 0) }}</div>
                  <div class="product-subtitle">Total</div>
                </div>
                <div class="col-8 col-md-3">
                  <button
                  type="submit"
                  class="btn btn-success mt-4 px-4 btn-block">
                  Checkout Now
                </button>
                </div>
              </div>
          </form>
        </div>
      </section>
    </div>  
    
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
              .then(function (response) {
                  self.regencies = response.data;
              })
          },
        },
        watch: {//untuk melihat perubahan data
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          },
        }
      });
    </script>
@endpush