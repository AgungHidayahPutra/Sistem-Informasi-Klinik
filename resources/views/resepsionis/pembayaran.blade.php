<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pembayaran | Resepsionis</title>
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
                        <div class="sb-sidenav-menu-heading text-lavender">Resepsionis</div>
                        <a class="nav-link text-lavender" href="/dashboard">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-house"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link text-lavender" href="/pasien">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-hospital-user"></i></div>
                            Pasien
                        </a>
                        <a class="nav-link text-lavender" href="/rekam-medis">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-laptop-medical"></i></div>
                            Rekam Medis
                        </a>
                        <a class="nav-link text-lavender" href="/jadwal">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-calendar-days"></i></div>
                            Jadwal
                        </a>
                        <a class="nav-link text-lavender" href="/dokter">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-user-doctor"></i></div>
                            Dokter
                        </a>
                        <a class="nav-link text-lavender" href="/poli">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-door-closed"></i></div>
                            Poli
                        </a>
                        <a class="nav-link text-lavender" href="/antrian">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-users-between-lines"></i></div>
                            Antrian
                        </a>
                        <a class="nav-link text-lavender active" href="/pembayaran">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-money-bill-wave"></i></div>
                            Pembayaran
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
                    <h1 class="mt-4">Pembayaran</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Pembayaran</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Pembayaran
                        </div>
                        <div class="card-body">

                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Pembayaran</button>

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Nama Dokter</th>
                                        <th>Layanan</th>
                                        <th>Nominal</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayarans as $index => $pembayaran)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pembayaran->pasien->nama_pasien }}</td>
                                        <td>{{ $pembayaran->dokter->nama_dokter }}</td>
                                        <td>{{ $pembayaran->layanan }}</td>
                                        <td>{{ $pembayaran->nominal }}</td>
                                        <td>{{ $pembayaran->jns_pembayaran }}</td>
                                        <td>{{ $pembayaran->tgl_pembayaran }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="tambahModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('pembayaran.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3 position-relative">
                                                    <label>Pasien</label>
                                                    <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="" autocomplete="off">
                                                    <input type="hidden" name="pasien_id" id="pasien_id">
                                                    <div id="list_pasien" class="list-group position-absolute w-100 z-10"></div>
                                                </div>

                                                <div class="mb-3 position-relative">
                                                    <label>Dokter</label>
                                                    <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" placeholder="" autocomplete="off">
                                                    <input type="hidden" name="dokter_id" id="dokter_id">
                                                    <div id="list_dokter" class="list-group position-absolute w-100 z-10"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Layanan</label>
                                                    <input type="text" name="layanan" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nominal</label>
                                                    <input type="number" name="nominal" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Jenis Pembayaran</label>
                                                    <input type="text" name="jns_pembayaran" class="form-control" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">Simpan</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function autocompleteInput(inputId, listId, hiddenId, route) {
            $('#' + inputId).on('keyup', function() {
                let query = $(this).val();
                if (query.length > 1) {
                    $.get(route, {
                        term: query
                    }, function(data) {
                        let listHtml = '';
                        data.forEach(item => {
                            listHtml += `<button type="button" class="list-group-item list-group-item-action" data-id="${item.id}" data-nama="${item.label}">${item.label}</button>`;
                        });
                        $('#' + listId).html(listHtml).fadeIn();
                    });
                } else {
                    $('#' + listId).fadeOut();
                }
            });

            $('#' + listId).on('click', 'button', function() {
                let nama = $(this).data('nama');
                let id = $(this).data('id');
                $('#' + inputId).val(nama);
                $('#' + hiddenId).val(id);
                $('#' + listId).fadeOut();
            });
        }

        $(document).ready(function() {
            autocompleteInput('nama_pasien', 'list_pasien', 'pasien_id', '/autocompletepembayaran/pasien');
            autocompleteInput('nama_dokter', 'list_dokter', 'dokter_id', '/autocompletepembayaran/dokter');
        });
    </script>

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