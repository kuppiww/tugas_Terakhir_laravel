<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Amandemy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-5">
                <br>
                <br>
                <br>
                <h2>Discover. Connect. Thrice.</h2>
                <h1 class="font-weight-bold">Transform your shopping experience</h1>
                <p class="small">Welcome to Amandemy to Amandemy, your ultimate destination for discovering the best products and transforming your shopping experience. Connect with a wide range of items tailored to meet your needs and desires. Explore our diverse catalog, enjoy seamless shopping, and experience unparalleled customer service. Join us on this journey to make your shopping more enjoyable and fulfilling. Happy shopping!</p>
                <a href="{{ route('get_product') }}" class="btn btn-primary mt-3">Buy</a>
            </div>
            <div class="col-md-6">
                <img src="https://i.pinimg.com/564x/b5/79/d2/b579d2c58e40859f67db0127965b8a96.jpg" class="img-fluid" alt="Shopping Image">
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>