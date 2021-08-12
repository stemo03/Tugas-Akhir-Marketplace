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
  <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img
                src="/images/detail/checklist.svg"
                alt="sukses"
                class="mb-4 w-50 h-50"
              />
              <h2>Welcome To Store!</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Recusandae quasi assumenda atque praesentium natus, quia
                voluptatem veniam, voluptates id optio illo odit repellat
                impedit enim possimus dignissimos maiores ex ut?
              </p>
              <a href="{{ route('dashboard') }}" class="btn btn-success w-50 mt-4"
                >My Dashboard</a
              >
              <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-2"
                >Go To Shopping</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection