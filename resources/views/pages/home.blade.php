@extends('layouts.app')

@section('title')
    Store Home Page
@endsection
@push('addon-style')
    <style>
      .my-jumbotron {
    
    background-size: cover;
    height: 450px;
    position: relative;
  }

  .my-jumbotron::after{
    display: block;
    width: 100%;
    height: 50%;
    content: '';
    position: absolute;
    background-image: linear-gradient(to top,rgba(0,0,0,1),rgba(0,0,0,0));
    bottom: 0;
  }
  .inner{
    overflow: hidden;
  }
.inner img{
  transition: all 1.5s ease;
  width: 100%;
  height: 200px;
}
.inner:hover img{
  transform: scale(1.5);
}



  </style>
@endpush
@section('content')
  <div class="page-content page-home">
      <section class="store-carousel">
        <div class="container">
          <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
              <div
                id="storeCarousel"
                class="carousel slide"
                data-ride="carousel"
              >
                <ol class="carousel-indicators">
                  <li
                    data-target="#storeCarousel"
                    data-slide-to="0"
                    class="active"
                  ></li>
                  <li data-target="#storeCarousel" data-slide-to="1"></li>
                  <li data-target="#storeCarousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      src="https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm313-k-181-nunny-01.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=89e02a525506dc687d32c0a2fd27d8ae"
                      class="d-block w-100 my-jumbotron"
                      alt="carousel image"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="images\banner (3).jpg"
                      class="d-block w-100 my-jumbotron"
                      alt="carousel image"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/v921-audi-wit-036_1.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=e174bcda77df75045740648ec5f7ccd0"
                      class="d-block w-100 my-jumbotron"
                      alt="carousel image"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

{{-- Categoory --}}
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Kategori</h5>
            </div>
            <div class="row">
              @php $incrementCategory = 0 @endphp
                @forelse ($categories as $category)
                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="{{ $incrementCategory+= 100 }}"
                    >
                        <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                            <div class="categories-image">
                                <img
                                src="{{  Storage::url($category->photo) }}"
                                alt=""
                                class="w-100 h-100"
                                />
                            </div>
                            <p class="categories-text">
                                {{  $category->name }}
                            </p>
                        </a>
                    </div>
                @empty
                    <div
                        class="col-12 text-center py-5"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        No Categories Found
                    </div>
                @endforelse
            </div>
          </div>
        </div>
      </section>



{{--        New Product      --}}
      <section class="store-new-products">
           <div class="container">
            <div class="row">
              <div class="col-12" data-aos="fade-up">
                <h5>New Products</h5>
              </div>
            </div>
            <div class="row">
                @php $incrementProduct = 0 @endphp
                  @forelse ($products as $product)
                    <div
                      class="col-6 col-md-4 col-lg-3"
                      data-aos="fade-up"
                      data-aos-delay="{{  $incrementProduct += 100 }}"
                    >
                        <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                            <div class="products-thumbnail">
                              <div
                                  class="products-image"
                                  style="
                                        @if($product->galleries->count())
                                            background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');
                                        @else
                                            background-color: #eee;
                                        @endif
                                    ">
                                </div>
                            </div>
                            <div class="products-text">
                                {{  $product->name }}
                            </div>
                            <div class="products-price">
                            Rp {{ number_format($product->price) }}
                            </div>
                            <div>
                              {{ $product->user->store_name ??''}}
                            </div>
                          </a>
                    </div>
                @empty
                    <div
                            class="col-12 text-center py-5"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            No Products Found
                    </div>
                @endforelse
              </div>
            </div>
      </section>


  {{-- Blog --}}
      <section class="store blog">
           <div class="container mt">
            <div class="row">
              <div class="col-12" data-aos="fade-up">
                <h5 >Informasi Pertanian Terbaru</h5>
              </div>
            </div>
            <div class="row justify-contenct-center mt-4">
              @php $incrementBlog= 0 @endphp
                @forelse ($blog as $item)
                    <div
                    class="col-md-4 "
                        data-aos="fade-up"
                        data-aos-delay="{{ $incrementBlog+= 100 }}"
                    >
                     
                          <div class="card border-secondary mb-3" style="max-width: 18rem;pad" >
                            <div class="inner">
                              <img class="card-img-top " src="{{  Storage::url($item->photo) }}" alt="Card image cap">
                            </div>
                              <div class="card-body text-center">
                                  <h5 class="card-title">{{  $item->name }}</h5>
                                  <p class="card-text">{{  $item->desc ?? '' }}</p>
                                  <a href="{{  $item->blog_url }}" class="btn btn-success">Lihat Informasi...</a>
                              </div>
                        </div>
                    </div>
                    
                @empty
                    <div
                        class="col-12 text-center py-5"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        No Information Found!
                    </div>
                @endforelse
            </div>
      </section>
        
    </div>
@endsection