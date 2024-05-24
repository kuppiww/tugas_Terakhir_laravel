<!-- resources/views/transaction/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title text-center font-weight-bold">Invoice Transaksi {{ $transaction->id }}</h1>
            <h2 class="text-right">Detail Transaksi</h2>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>No. Invoice:</strong> {{ $transaction->invoice_number }}</p>
                    <p><strong>Admin Fee:</strong> Rp {{ number_format($transaction->admin_fee, 0, ',', '.') }}</p>
                    <p><strong>Kode Unik:</strong> {{ $transaction->unique_code }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ $transaction->payment_method }}</p>
                    <p><strong>Status:</strong> {{ $transaction->status }}</p>
                    <p><strong>Tanggal Kadaluwarsa:</strong> {{ $transaction->expiry_date->format('d M Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <h4>Produk yang Dibeli</h4>
                    <ul>
                        @foreach($transaction->product as $product)
                        <li>{{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <hr>
            <h4>Data Pembelian</h4>
            <p><strong>Nama:</strong> {{ $transaction->user->name }}</p>
            <p><strong>Email:</strong> {{ $transaction->user->email }}</p>
            <p><strong>Handphone:</strong> {{ $transaction->user->phone }}</p>
            <p><strong>Alamat:</strong> {{ $transaction->user->address }}</p>
        </div>
    </div>
</div>
@endsection