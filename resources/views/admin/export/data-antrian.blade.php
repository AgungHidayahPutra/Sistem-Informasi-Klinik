<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Antrian</title>
    <link rel="icon" href="{{ asset('assets/images/logo-klinik.svg') }}" type="image/svg+xml" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

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

        .btn-copy {
            background-color: #c4ad9d !important;
            color: white !important;
        }

        .btn-csv {
            background-color: #17a2b8 !important;
            color: white !important;
        }

        .btn-excel {
            background-color: #28a745 !important;
            color: white !important;
        }

        .btn-pdf {
            background-color: #dc3545 !important;
            color: white !important;
        }

        .btn-print {
            background-color: #ffc107 !important;
            color: black !important;
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
                    <h1 class="mt-4">Antrian</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Antrian</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Antrian
                        </div>
                        <div class="card-body">

                            <div class="export-buttons"></div>

                            <table class="table table-bordered" id="exportstock" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Nama Poli</th>
                                        <th>Nama Dokter</th>
                                        <th>Status Antrian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($antrians as $index => $antrian)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $antrian->pasien->nama_pasien }}</td>
                                        <td>{{ $antrian->poli->nama_poli }}</td>
                                        <td>{{ $antrian->dokter->nama_dokter }}</td>
                                        <td>{{ $antrian->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

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

    <script>
        $(document).ready(function() {
            var table = $('#exportstock').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Salin Data',
                        className: 'btn-copy'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i> Ekspor CSV',
                        className: 'btn-csv'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Ekspor Excel',
                        className: 'btn-excel'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> Ekspor PDF',
                        className: 'btn-pdf'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Cetak',
                        className: 'btn-print'
                    }
                ]
            });

            table.buttons().container().appendTo('.export-buttons');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>

</html>