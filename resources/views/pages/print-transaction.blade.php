<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

</head>
<style>
* {
  font-family: sans-serif; /* Change your font family */
}

.content-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  min-width: 100%;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.content-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
}

.content-table th,
.content-table td {
  padding: 15px 35px;
  border-left:1px solid #e0e0e0;
  border-bottom: 1px solid #e0e0e0;
  text-align: center;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

</style>
<body>
    @csrf
	<div class="mt-5">
    <center>
      <h1 style="font-family: sans-serif;" class="mt-6">Laporan Transaksi Penjualan Toko</h1>
    </center>
  </div>
    <div class="container form-group">
    <h5>Jumlah Transaksi    : {{ $transaction_count}} </h5>
    <h5>Total Pendapatan    : Rp {{number_format( $revenue)}} </h5>
    <center>
       
<table class="content-table">
		<thead>
			<tr>
            <th>No.</th>
            <th>Kode Transaksi</th>
            <th>Nama Customer</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Status</th>
            <th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
             @foreach ($transaction_data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->transaction->code?? '' }}</td>
                <td>{{ $item->transaction->user->name ?? ''}}</td>
                 <td>{{ $item->product->name ?? ''}}</td>
                <td> Rp. {{ number_format($item->product->price +30000) ?? '' }}</td>
                <td>{{ $item->transaction->transaction_status ?? '' }}</td>
                <td>{{ $item->transaction->created_at ?? '' }}</td>
                

            </tr>
        @endforeach
        </tbody>
	</table>
    </center>
    </div>

    {{-- <script type="text/javascript">
      window.print();
    </script> --}}
    
</body>
</html>
