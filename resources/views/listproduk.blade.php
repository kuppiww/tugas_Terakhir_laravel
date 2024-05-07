<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Product</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .container {
        background-color: #87CEEB;
    }
</style>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <h2>List Product</h2>
            </div>
            <div class="col-md-9 text-right">
                <a href="{{ route('listproduk.userProfile')}}" class="btn btn-primary">Lihat Profil</a>
                <a href="{{ route('listproduk.input') }}" class="btn btn-dark">Tambah Produk</a>
                <a href="{{ route('listproduk.lihatproduk') }}" class="btn btn-secondary">Kembali ke Produk</a>
            </div>
        </div>
        <table class="table mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1 @endphp
                @foreach ($products as $product)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$product->nama}}</td>
                    <td>{{$product->stok}}</td>
                    <td>{{$product->berat}}</td>
                    <td>Rp.{{$product->harga}}</td>
                    <td>{{$product->kondisi}}</td>
                    <td>
                        <a href="{{ route('listproduk.formedit', $product->id) }}" class="btn btn-warning btn-sm">Update</a>
                        <form action="{{ route('listproduk.delete', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>