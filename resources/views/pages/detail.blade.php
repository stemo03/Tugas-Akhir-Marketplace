@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection
@push('addon-style')
    <style>
       .quantities {
            font-weight: normal;
            font-size: 12px;
            /* line-height: 27px; */
            color: #008b8b;
            margin-top: -5px;
            margin-bottom: 5px;
        }
    </style>
@endpush

@section('content')
    <!-- Page Content -->
    <div class="page-content page-details">
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
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Product Details
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-gallery mb-3" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img
                  :src="photos[activePhoto].url"
                  :key="photos[activePhoto].id"
                  class="w-100 main-image"
                  alt=""
                />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div
                  class="col-3 col-lg-12 mt-2 mt-lg-0"
                  v-for="(photo, index) in photos"
                  :key="photo.id"
                  data-aos="zoom-in"
                  data-aos-delay="100"
                >
                  <a href="#" @click="changeActive(index)">
                    <img
                      :src="photo.url"
                      class="w-100 thumbnail-image"
                      :class="{ active: index == activePhoto }"
                      alt=""
                    />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <h1 style="font-family: serif;color:black" class="mt-2 mb-1">{{ $product->name }}</h1>
                <div class="owner">By 
                  <a href="{{ route('shop', $product->slug) }}">{{ $product->user->store->store_name ?? '' }}</a>
                </div>
                <div class="price">Rp. {{ number_format($product->price) }}</div>
                <div class="quantities">Stock Barang  :  {{ number_format($product->quantities) }}</div>
              </div>
              <div class="col-lg-2" data-aos="zoom-in">
                @auth
                   <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <button
                        type="submit"
                        class="btn btn-success px-4 text-white btn-block mb-3"
                      >
                        Add to Cart
                      </button>
                    </form>
                @else
                    <a
                      href="{{ route('login') }}"
                      class="btn btn-success px-4 text-white btn-block mb-3"
                    >
                      Sign in to Add
                    </a>
                @endauth
              </div>
            </div>
          </div>
        </section>
        <section class="store-description ">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 ">
                <h5 style="font-family: serif;color:black">Deskripsi Produk :</h5>
                {!! $product->description !!}
                <hr size="10px" style="height:2px;border-width:0;color:gray;background-color:gray">
              </div>
            </div>
          </div>


        </section>
        <section class="store-review">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 mt-3 mb-3">

                @php
                    $com_Q=$comment_count->count();
                @endphp
                <h4 style="font-family: serif;color:black" class="mt-2 mb-1">Customer Review ({{ $com_Q ?? '0'}})</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6">
                @if (count($comment_count) > 0)

                  @foreach ($comment as $item)
          
                  <ul class="list-unstyled">
                    
                    <li class="media">
                      <img
                        src="{{ $item->user->profile_photo_path ?? 'https://ui-avatars.com/api/?name=' . $item->user->name }}"
                        alt=""
                        class="mr-3 rounded-circle"
                      />
                      <div class="media-body mb-0">
                        <u>
                          <h5 style="font-family: serif;color:black" class="mt-2 mb-1">{{ $item->user->name }}</h5>
                        </u>
                        <h6>
                          {{ $item->created_at }}
                        </h6>
                          <p style="font-family: Georgia, serif;color:black;text-align:justify" class="mb-0">{{ $item->comment }}</p>
                      </div>
                    </li>
                  </ul>
                  
                  @endforeach
                  @auth
                        <div class="media-body my-4">
                      <form action="{{ route('commentar') }}" method="POST">
                        @csrf
                          <input type="hidden" name="products_id" value="{{ $product->id }}">
                          <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                          
                          <textarea name="comment" placeholder="Masukan Pesan" cols="20" rows="5" class="form-control"></textarea>
                          <button type="submit" class="btn btn-success mt-2"> Send</button>
                      </form>
                      </div>
                    @endauth
                @else
                <ul class="list-unstyled">
                  <li class="media">
                   Belum Ada Comentar
                    
                  </li>

                   @auth
                       <div class="media-body my-4">
                     <form action="{{ route('commentar') }}" method="POST">
                       @csrf
                        <input type="hidden" name="products_id" value="{{ $product->id }}">
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        
                        <textarea name="comment" placeholder="Masukan Pesan" cols="20" rows="5" class="form-control"></textarea>
                        <button type="submit" class="btn btn-success mt-2"> Send</button>
                     </form>
                    </div>
                   @endauth
                 
                </ul>
                
                @endif
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
@endsection



@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach ($product->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photos) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
@endpush