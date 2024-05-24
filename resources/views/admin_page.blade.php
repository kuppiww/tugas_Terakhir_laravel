<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar-nav {
            margin-left: auto;
        }

        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .filter-bar .form-select,
        .filter-bar .form-control {
            width: auto;
        }

        .filter-bar .btn {
            margin-left: 10px;
        }

        .entries-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .entries-bar .form-select {
            width: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="https://dashboard.amandemy.co.id/images/amandemy-logo.png" width="150" height="50" alt="Amandemy Logo">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto" style="margin-left: auto;">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('get_product') }}">PRODUCTS</a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-primary fw-bold">LOGIN</a>
                </li>
                @else
                @if(Auth::user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin_page', ['user' => 1]) }}">MANAGE PRODUCTS</a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container mt-lg-4 mb-lg-3">
        <div class="row bg-info rounded px-3 py-3 w-100">
            <div class="d-flex justify-content-between">
                <h2 class="fw-semibold">List Product</h2>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('get_profile', ['user' => $user->id]) }}" class="btn btn-md btn-primary fw-bold my-auto me-1">Lihat Profil</a>
                    <a href="{{ route('form_product', ['user' => $user->id]) }}" class="btn btn-md btn-dark fw-bold my-auto me-1">Tambah Produk</a>
                    <button type="button" class="btn btn-md btn-success fw-bold my-auto me-1" data-bs-toggle="modal" data-bs-target="#importModal">Import Produk</button>
                    <a href="#" class="btn btn-md btn-warning fw-bold my-auto me-1">Export Produk</a>
                </div>
            </div>
            <div class="filter-bar d-flex justify-content-between align-items-center">
                <div>
                    <select id="conditionFilter" class="form-select">
                        <option value="all">Pilih Kondisi Barang</option>
                        <option value="new">Baru</option>
                        <option value="used">Bekas</option>
                    </select>
                </div>
                <div class="search-bar">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
            </div>




            <div class="entries-bar">
                <div>
                    <label for="showEntries" class="form-label">Show</label>
                    <select id="showEntries" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label for="showEntries" class="form-label">entries</label>
                </div>
            </div>
            <table class="table table-striped w-100 mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-center">Berat</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Kondisi</th>
                        <th scope="col" class="text-center" style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $product->name }}</td>
                        <td class="text-center">{{ $product->stock }}</td>
                        <td class="text-center">{{ $product->weight }}</td>
                        <td class="text-center">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                        @if ($product->condition == 'Baru')
                        <td class="text-center">
                            <div class="rounded px-3 py-1 bg-success w-50 mx-auto">{{ $product->condition }}</div>
                        </td>
                        @else
                        <td class="text-center">
                            <div class="rounded px-3 py-1 bg-dark text-white w-50 mx-auto">{{ $product->condition }}</div>
                        </td>
                        @endif
                        <td class="d-flex">
                            <a href="{{ route('edit_product', ['product' => $product->id, 'user' => $user->id]) }}" class="btn btn-warning btn-md">Update</a>
                            <form action="{{ route('delete_product', ['product' => $product->id, 'user' => $user->id]) }}" method="POST" class="ms-1">
                                @csrf()
                                <button class="btn btn-md btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="#" class="btn btn-link">Klik untuk mengunduh template import</a>
                    <div class="mb-3 mt-3">
                        <label for="formFile" class="form-label">Data Excel</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>