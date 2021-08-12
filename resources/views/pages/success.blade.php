@extends('layouts.success')

@section('title')
    Store Success Page
@endsection

@section('content')
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img
                src="/images/detail/approved.svg"
                alt="sukses"
                class="mb-4 w-50 h-50"
              />
              <h2>Transaction Prosessed!</h2>
              <p>
                Silahkan selesaikan transaksi pembelian anda dengan membayar dengan total harga yang telah di tentukan, lakukan pembayaran sesuai dengan metode yang anda pilih. Jika sudah melakukan pembayaran, silahkan tungggu dan pantau transaksi anda di Dahboard anda! <br> Terima kasih terlah berbelanja!
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