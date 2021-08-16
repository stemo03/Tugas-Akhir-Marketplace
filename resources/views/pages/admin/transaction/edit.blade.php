@extends('layouts.admin')

@section('title')
  Store Settings
@endsection

@section('content')
<!-- Section Content -->
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Transaction</h2>
        <p class="dashboard-subtitle">
            Edit "{{ $item->transaction->user->name }}" Transaction
        </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Transaction Status</label>
                      <select name="transaction_status" class="form-control" disabled>
                        <option value="{{ $item->transaction->transaction_status }}">{{ $item->transaction->transaction_status }}</option>
                        <option value="" disabled>----------------</option>
                        <option value="PENDING">PENDING</option>
                        <option value="SHIPPING">SHIPPING</option>
                        <option value="SUCCESS">SUCCESS</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Total Price</label>
                      <input type="number" class="form-control" name="total_price" value="{{ $item->transaction->total_price }}" disabled />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Status Pengririman</label>
                      <input type="text" class="form-control" name="shipping_status" value="{{ $item->shipping_status }}" disabled />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Informasi Seller (Nama Toko)</label>
                      <input type="text" class="form-control" name="shipping_status" value="{{ $item->product->user->store->store_name }}" disabled />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Rekening Bank</label>
                      <input type="text" class="form-control" name="shipping_status" value="{{ $item->product->user->store->bank }}" disabled />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nomor Rekening Seller</label>
                      <input type="text" class="form-control" name="shipping_status" value="{{ $item->product->user->store->no_rek }}" disabled />
                    </div>
                  </div>
                  

                  <form action="{{ route('kirim', $item->code) }}" method="post" enctype="multipart/form-data">
                    @csrf
                      <div class="col-md-12">
                        
                        <div class="row">
                          <div class="col text-right">
                            <button
                              type="submit"
                              class="btn btn-success px-5"
                            >
                              Kirim Email
                            </button>
                          </div>
                        </div>
                      </div>
                  </form>

                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@push('addon-script')
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor');
  </script>
@endpush