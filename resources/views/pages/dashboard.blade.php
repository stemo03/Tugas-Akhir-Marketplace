@extends('layouts.dashboard')

@section('title')
    Store Dashboard
@endsection

@section('content')
<!-- Section Content -->
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
    <div class="dashboard-heading">
    <h2 class="dashboard-title">Dashboard</h2>
    <p class="dashboard-subtitle">
        Look what you have made today!
    </p>
    </div>
    <div class="dashboard-content">
    <div class="row">
        <div class="col-md-4">
        <div class="card mb-2">
            <div class="card-body">
            <div class="dashboard-card-title">
                Customer
            </div>
            <div class="dashboard-card-subtitle">
                {{ number_format($customer) }}
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card mb-2">
            <div class="card-body">
            <div class="dashboard-card-title">
                Revenue
            </div>
            <div class="dashboard-card-subtitle">
               Rp {{ number_format($revenue) }}
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card mb-2">
            <div class="card-body">
            <div class="dashboard-card-title">
                Transaction
            </div>
            <div class="dashboard-card-subtitle">
                {{ number_format($transaction_count) }}
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 float-lg-right" >
            @php
                use App\Models\User_roles;
                use App\Models\Store;
                $user = User_roles::select('role_id')->where('user_id', Auth::user()->id)->whereIn('role_id', [1, 2, 3])->get();
                $store = Store::where('user_id', Auth::user()->id)->first();

            @endphp
            @if($user && $store != null)
                <a href="{{ route('print') }}" class="btn btn-primary" target="_blank" ><i class="fas fa-print"></i> Cetak </a>
            @endif
        </div>
        
    </div>
    <div class="row mt-3">
        <div class="col-12 mt-2">
            <h5 class="mb-3">Recent Transactions</h5>
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                    Produk
                </div>
                 <div class="col-md-2">
                    Kode transaksi
                </div>
                <div class="col-md-2">
                    Customer
                </div>
                <div class="col-md-2">
                    Pembayaran
                </div>
                <div class="col-md-2">
                Tanggal Transaksi
                </div>
            </div>
            @foreach ($transaction_data as $transaction)
              <a
                href="{{ route('dashboard-transaction-details', $transaction->id) }}"
                class="card card-list d-block"
                >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img
                                src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                class="w-75"
                            />
                        </div>
                        <div class="col-md-2">
                                {{ $transaction->product->name ?? '' }}
                            </div>
                            <div class="col-md-2">
                                {{ $transaction->transaction->code ?? '' }}
                            </div>
                            <div class="col-md-2">
                                {{ $transaction->transaction->user->name ?? '' }}
                            </div>
                            <div class="col-md-2">
                            {{ $transaction->transaction->transaction_status}}
                            </div>
                            <div class="col-md-2">
                                {{  $transaction->created_at ?? '' }}
                            </div>
                            <div class="col-md-1 d-none d-md-block">
                                <img
                                    src="/images/dashboard-arrow-right.svg"
                                    alt=""
                                />
                        </div>
                    </div>
                </div>
            </a>  
            @endforeach
        </div>
    </div>
    </div>
</div>
</div>
@endsection