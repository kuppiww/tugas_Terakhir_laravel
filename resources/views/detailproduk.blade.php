@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $product->name }}</h1>
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 300px;">
            <p>{{ $product->description }}</p>
            <p>Price: ${{ $product->price }}</p>
            <!-- Tambahkan informasi produk lainnya sesuai kebutuhan -->
        </div>
    </div>
</div>
@endsection