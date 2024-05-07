<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OUTPUT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-primary {
            width: 100%;
        }

        .card-title {
            display: inline-block;
            font-weight: bolder;
        }

        .berat {
            display: inline-block;
            float: right;
            background-color: #A9A9A9;
            color: white;
        }

        .harga {
            display: inline-block;
            margin-left: 19%;
            background-color: #1E90FF;
        }

        .stok {
            display: inline-block;
            float: left;
            background-color: #006400;
            color: white;
        }

        .kondisi {
            display: inline-block;
            font-weight: 600;
            margin-left: 19%;
        }


        .product-h2 {
            text-align: center;
            font-weight: bolder;
        }

        .container {
            background-color: #87CEEB;
        }

        .btn-dark {
            margin-right: 80%;
        }
    </style>
</head>

<body>


    <section class="product">
        <div class="container">
            <h2 class="product-h2">PRODUCTS</h2>

            <div class="container text-end my-2">
                <a href="{{ route('listproduk.listproduk') }}" class="btn btn-dark">Ke halaman Admin</a>
                <a href="{{ route('listproduk.merchant') }}" class="btn btn-success">Ke Halaman Merchant</a>
            </div>
            <div class="row row-cols-1 row-cols-md-4">
                @foreach ($products as $product)
                <div class="col mb-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $product->gambar }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                            <p class="kondisi">{{ $product->kondisi }}</p>
                            <br><br>
                            <p class="stok">{{ $product->stok }}</p>
                            <p class="harga">Rp.{{ $product->harga }}</p>
                            <p class="berat">{{ $product->berat }} gr</p>
                            <br><br>
                            <p class="card-text">Deskripsi: {{ $product->deskripsi }}</p>
                            <button type="button" class="btn btn-primary">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>