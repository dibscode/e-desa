<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - E-Desa</title>
    
    @include('include.style')

</head>

<body>
    <div id="app">
        @include('include.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
            <div class="page-heading d-flex justify-content-between align-items-center">
                <h3>Selamat datang, {{ Auth::user()->name }}</h3>
                <a href="{{ route('user.logout') }}" 
                   class="btn btn-danger d-flex align-items-center gap-2">
                    <span><i class="bi bi-box-arrow-right"></i> Keluar </span>
                </a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            
            @yield('content')
<br>
            @include('include.footer')

        </div>
    </div>
    
    @include('include.script')

</body>

</html>
