<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Export | Admin</title>
    <link rel="icon" href="{{ asset('assets/images/logo-klinik.svg') }}" type="image/svg+xml" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @font-face {
            font-family: "calsans";
            src: url("/assets/fonts/CalSans/CalSans-Regular.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        .calsans {
            font-family: 'calsans';
        }

        .bg-green {
            background-color: #40A578;
        }

        .bg-body-white {
            background-color: #E6E6FA;
        }

        .bg-blue {
            background-image: linear-gradient(to bottom, #004AAD, #004AAD, #5080FD);
        }

        .logo {
            width: 130px;
        }

        .text-lavender {
            color: #E6E6FA !important;
        }

        .active {
            text-decoration: underline;
        }

        .list-group {
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            z-index: 999;
        }

        .card-export {
            padding: 30px 20px;
        }

        .btn-export-antrian,
        .btn-export-pasien,
        .btn-export-rekam-medis,
        .btn-export-pembayaran {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 90%;
            height: 100px;
            font-weight: bolder;
            font-size: 20px;
            color: #000000;
            text-decoration: none;
        }

        .btn-export-antrian {
            background-color: #4fc1e9;
        }

        .btn-export-antrian:hover {
            background-color: #359CC1;
            color: #000000;
        }

        .btn-export-pasien {
            background-color: #48cfad;
        }

        .btn-export-pasien:hover {
            background-color: #32AF8E;
            color: #000000;
        }

        .btn-export-rekam-medis {
            background-color: #fc6e51;
        }

        .btn-export-rekam-medis:hover {
            background-color: #C54024;
            color: #000000;
        }

        .btn-export-pembayaran {
            background-color: #eee7ca;
        }

        .btn-export-pembayaran:hover {
            background-color: #dcceac;
            color: #000000;
        }
    </style>
</head>

<body class="sb-nav-fixed bg-body-white calsans">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-white">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href=""><img src="{{ asset('assets/images/logo-klinik.png') }}" alt="" class="logo"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-dark" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-blue" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading text-lavender">Admin</div>
                        <a class="nav-link text-lavender" href="/dashboard">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-house"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link text-lavender" href="/rekam-medis">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-laptop-medical"></i></div>
                            Rekam Medis
                        </a>
                        <a class="nav-link text-lavender" href="/dokter">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-user-doctor"></i></div>
                            Dokter
                        </a>
                        <a class="nav-link text-lavender" href="/poli">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-door-closed"></i></div>
                            Poli
                        </a>
                        <a class="nav-link text-lavender" href="/pembayaran">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-money-bill-wave"></i></div>
                            Pembayaran
                        </a>
                        <a class="nav-link text-lavender active" href="/export">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-file-export"></i></div>
                            Export Data
                        </a>
                        <a class="nav-link text-lavender" href="/user">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-user"></i></div>
                            User Account
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer bg-white text-dark">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->username }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Export Data</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Export Data</li>
                    </ol>
                    <div class="card mb-4 bg-dark text-light mt-3">
                        <div class="card-export">
                            <div class="row d-flex flex-column flex-md-row">
                                <div class="col mb-3 mb-md-0"><a href="/export/data-antrian" class="btn btn-export-antrian">Antrian</a></div>
                                <div class="col mb-3 mb-md-0"><a href="/export/data-pasien" class="btn btn-export-pasien">Pasien</a></div>
                                <div class="col mb-3 mb-md-0"><a href="/export/data-rekam-medis" class="btn btn-export-rekam-medis">Rekam Medis</a></div>
                                <div class="col mb-3 mb-md-0"><a href="/export/data-pembayaran" class="btn btn-export-pembayaran">Pembayaran</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto bg-white">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-dark">Copyright &copy; Klinik Pangeran 2025</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}"
        });
    </script>
    @endif
</body>

</html>