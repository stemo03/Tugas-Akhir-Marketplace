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
                        Terimakasih!
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
                                
                                <h2>Transaksi Selesai</h2>
                                 <p class="mt-3">
                                <b> Transaksi penjualan anda berhasil dan telah sampai kepada pengguna. Cek rekening anda.
                            </p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection
