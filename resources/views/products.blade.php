<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <div class="mx-lg-5 mt-lg-4 mb-lg-3">
        <div class="rounded bg-info pt-3 pb-3">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-start">
                    <a href="{{ route('admin_page', ['user' => 1]) }}" class="btn btn-md btn-primary fw-bold ms-3 h-75 m-auto">Halaman Pengguna 1</a>
                </div>
                <div class="col-md-4">
                    <h2 class="text-center fw-bold mt-2">PRODUCTS</h2>
                </div>
            </div>
            <div class="mt-3 bg-dark mx-auto rounded" style="height: 3px;width: 75px"></div>
            <div class="grid mx-3 mt-4">
                <div class="row row-gap-4">
                    @foreach ($products as $item)
                    <div class="col-3">
                        <div class="card bg-white w-100">
                            <img class="rounded" src="{{asset('storage/images/'. $item->image ) }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between my-2">
                                    <p class="card-title fw-bold my-auto" style="font-size: 24px">
                                        {{ $item->name }}
                                    </p>
                                    @if ($item->condition == 'Baru')
                                    <p class="my-auto rounded py-1 bg-success px-2 fw-semibold" style="font-size: 16px">{{ $item->condition }}
                                    </p>
                                    @else
                                    <p class="my-auto rounded py-1 bg-warning px-2 fw-semibold" style="font-size: 16px">{{ $item->condition }}
                                    </p>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between my-2">
                                    <p class="my-auto rounded py-1 bg-success px-2 text-white fw-semibold" style="font-size: 16px">{{ $item->stock }}
                                    </p>
                                    <p class="my-auto rounded py-1 bg-info px-2 fw-semibold" style="font-size: 16px">Rp.
                                        {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                    <p class="my-auto rounded py-1 bg-secondary text-white px-2 fw-semibold" style="font-size: 16px">{{ $item->weight }} gr
                                    </p>
                                </div>
                                <p class="" style="overflow: hidden;max-width: 400px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin: 10px auto;">
                                    {{ $item->description }}
                                </p>
                                <a href="{{ route('home') }}" class="btn btn-primary w-100">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>