@extends('layouts.laravel-default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <img src="https://image.flaticon.com/icons/png/512/2917/2917734.png" alt="Marketplace" style="width: 10%; height:10%">
                    <br>
                    <div>
                        Silahkan Verifikasi Email Anda
                    </div>
                    <div>
                        {{ Auth::user()->email }}
                    </div>
                </div>
                
                <center>
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
                                 <p class="mt-3">
                                <b> Farmers markeplace Indonesia</b> merupakan salah satu solusi belanja kebutuhan peoduk dan peralatan pertanian di tengah pandemi COVID-19. Diharapkan dengan adanya aplikasi ini, para petani dan masyarakat dapat memenuhi kebutuhan tumbuhannya dengan baik.
                            </p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <center>
                            <button type="submit" class="btn btn-success p-0 m-0 align-baseline p-2">
                                {{ __('Click Here To Request Another') }}
                            </button>
                        </center>
                    </form>
                </div>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection
