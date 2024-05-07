<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .box {
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            width: 100%;

        }

        .btn {
            margin-left: 40%;
        }
    </style>
</head>

<body>
    <a href="{{ route('listproduk') }}" class="btn btn-success mb-3">Kembali ke Halaman Admin</a>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="box">
                    <h2>Informasi Akun</h2>
                    <p>Nama Akun: {{ $accountName }}</p>
                    <p>Email: {{ $email }}</p>
                    <p>Gender: {{ $gender }}</p>
                    <p>Umur: {{ $age }}</p>
                    <p>Tanggal Lahir: {{ $birthdate }}</p>
                    <p>Alamat: {{ $address }}</p>
                </div>
            </div>
            <div class="col">
                <div class="box">
                    <h2>Informasi Toko</h2>
                    <p>Nama Toko: {{ $storeName }}</p>
                    <p>Rate: {{ $storeRate }}</p>
                    <p>Produk Terbaik: {{ $bestProduct }}</p>
                    <p>Deskripsi: {{ $storeDescription }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>