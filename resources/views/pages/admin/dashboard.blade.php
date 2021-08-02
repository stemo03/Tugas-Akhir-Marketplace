@extends('layouts.admin')

@section('title')
    Admin Dashboard
@endsection


@section('content')
{{-- Section Konten --}}
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title"> Admin Dashboard</h2>
            <p class="dashboard-subtitle">
                This is Farm Life Marketplace Admin User
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div
                                class="dashboard-card-title"
                            >
                                Customer 
                            </div>
                            <div
                                class="
                                    dashboard-card-subtitle
                                "
                            >
                                {{ $customer }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div
                                class="dashboard-card-title"
                            >
                                Revenue
                            </div>
                            <div
                                class="
                                    dashboard-card-subtitle
                                "
                            >
                               Rp {{ number_format($revenue) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div
                                class="dashboard-card-title"
                            >
                                Transaction
                            </div>
                            <div
                                class="
                                    dashboard-card-subtitle
                                "
                            >
                                {{ $transaction }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>



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
                                  {{-- <p class="card-text">{{  $item->desc ?? '' }}</p> --}}
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
