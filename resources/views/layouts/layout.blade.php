
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Muxir</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Muxir</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown" title="Korzinkani tozalash">
                    <form action="{{ route('RetsertKorzinka') }}" method="post">
                        @csrf 
                        <button class="nav-link nav-icon" href="{{ route('korzinka') }}">
                            <i class="bi bi-trash text-danger"></i>
                            <span class="badge bg-warning badge-number">@include('layouts.alert.delete')</span>
                        </button>
                    </form>
                </li>
                <li class="nav-item dropdown" title="Korzinka">
                    <a class="nav-link nav-icon" href="{{ route('korzinka') }}">
                        <i class="bi bi-basket"></i>
                        <span class="badge bg-success badge-number">@include('layouts.alert.korzinka')</span>
                    </a>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        @guest
                        @else
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->email }}</span>
                        </li>
                        <li><hr class="m-0 p-0">
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('updatePassword') }}">
                                <i class="bi bi-lock"></i>
                                <span>Parolni yangilash</span>
                            </a>
                        </li>
                        <li><hr class="m-0 p-0">
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf </form>
                        </li>
                        @endguest
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
  
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('tarqatildi') }}">
                    <i class="bi bi-rss"></i>
                    <span>Tarqatildi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('faktura') }}">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <span>Faktura</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('bolim') }}">
                    <i class="bi bi-bank2"></i>
                    <span>Bo'lim (hodimlar)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('chart') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span>Statistika</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('xisobot') }}">
                    <i class="bi bi-file-excel"></i>
                    <span>Hisobot</span>
                </a>
            </li>
            @if(auth()->user()->email=='elshodatc1116@gmail.com')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('Hodimlar') }}">
                    <i class="bi bi-people"></i>
                    <span>Hodimlar</span>
                </a>
            </li>
            @endif
        </ul>

    </aside>
  
    @yield('content')


    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>