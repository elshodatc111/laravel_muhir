
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/favicon1.png" rel="icon">
  <link href="assets/img/apple-touch-icon1.png" rel="apple-touch-icon">
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
                <img src="assets/img/logo1.png" alt="">
                <p class="pt-2 w-100 text-black">"HET" AJ " ENERGOSAVDO"<br> FILIALI QASHQADARYO <br>bo'linmasi</p>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown" title="Mavjud naryad blankalar">
                    <a class="nav-link nav-icon" href="{{ route('naryad_blanka') }}">
                        <i class="bi bi-card-list"></i>
                        <span class="badge bg-info badge-number">@include('layouts.alert.mavjud_blanka')</span>
                    </a>
                </li>
                <li class="nav-item dropdown" title="Yig'ilgan naryad blankalar">
                    <a class="nav-link nav-icon" href="{{ route('naryad_blanka_korzinka') }}">
                        <i class="bi bi-card-list"></i>
                        <span class="badge bg-warning badge-number">@include('layouts.alert.naryad_blanka')</span>
                    </a>
                </li>
                <li class="nav-item dropdown" title="Mavjud muxirlar">
                    <a class="nav-link nav-icon" href="{{ route('muxirs') }}">
                        <i class="bi bi-hourglass-split"></i>
                        <span class="badge bg-info badge-number">@include('layouts.alert.mavjud_muxir')</span>
                    </a>
                </li>
                <li class="nav-item dropdown" title="Yig'ilgan muxirlar">
                    <a class="nav-link nav-icon" href="{{ route('muxir_korzinka') }}">
                        <i class="bi bi-hourglass-split"></i>
                        <span class="badge bg-warning badge-number">@include('layouts.alert.muxir')</span>
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
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin_profel') }}">
                                <i class="bi bi-lock-fill"></i>
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
                    <i class="bi bi-house"></i>
                    <span>Home</span>
                </a>
            </li>
            @if(auth()->user()->role==1 OR auth()->user()->role==2 OR auth()->user()->role==3)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('muxirs') }}">
                    <i class="bi bi-hurricane"></i>
                    <span>Muxirlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('naryad_blanka') }}">
                    <i class="bi bi-file-earmark-diff-fill"></i>
                    <span>Naryad(blanka)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-sd-card-fill"></i>
                    <span>Sim kartalar</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('naryad') }}">
                    <i class="bi bi-folder-fill"></i>
                    <span>Naryadlar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('arxiv_muxir') }}">
                    <i class="bi bi-file-medical-fill"></i>
                    <span>Arxiv</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('qidruv_muxir') }}">
                    <i class="bi bi-search"></i>
                    <span>Qidruv</span>
                </a>
            </li>
            @if(auth()->user()->role==1 OR auth()->user()->role==2)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('bolim') }}">
                    <i class="bi bi-file-person"></i>
                    <span>Bo'limlar(Hodimlar)</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role==1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin_user') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Administrator</span>
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