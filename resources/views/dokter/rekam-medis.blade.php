<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Rekam Medis | Dokter</title>
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
                        <div class="sb-sidenav-menu-heading text-lavender">Dokter</div>
                        <a class="nav-link text-lavender" href="/dashboard">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-house"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link text-lavender active" href="/rekam-medis">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-laptop-medical"></i></div>
                            Rekam Medis
                        </a>
                        <a class="nav-link text-lavender" href="/jadwal">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-calendar-days"></i></div>
                            Jadwal
                        </a>
                        <a class="nav-link text-lavender" href="/data-dokter">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-user-doctor"></i></div>
                            Dokter
                        </a>
                        <a class="nav-link text-lavender" href="/antrian">
                            <div class="sb-nav-link-icon text-lavender"><i class="fa-solid fa-users-between-lines"></i></div>
                            Antrian
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
                    <h1 class="mt-4">Rekam Medis</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Rekam Medis</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Rekam Medis
                        </div>
                        <div class="card-body">

                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Nama Poli</th>
                                        <th>Nama Dokter</th>
                                        <th>Keluhan</th>
                                        <th>Resep Obat</th>
                                        <th>Penyakit</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datarekammedis as $index => $rekammedis)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rekammedis->pasien->nama_pasien }}</td>
                                        <td>{{ $rekammedis->poli->nama_poli }}</td>
                                        <td>{{ $rekammedis->dokter->nama_dokter }}</td>
                                        <td>{{ $rekammedis->keluhan }}</td>
                                        <td>{{ $rekammedis->resep_obat }}</td>
                                        <td>{{ $rekammedis->penyakit }}</td>
                                        <td>{{ $rekammedis->tgl_daftar }}</td>
                                        <td>
                                            <!-- Edit -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $rekammedis->id }}">Edit</button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $rekammedis->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form action="{{ route('rekam-medis.update', $rekammedis->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Rekam Medis</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label>Pasien</label>
                                                            <select name="pasien_id" class="form-control" required>
                                                                @foreach($pasiens as $pasien)
                                                                <option value="{{ $pasien->id }}" {{ $rekammedis->pasien_id == $pasien->id ? 'selected' : '' }}>
                                                                    {{ $pasien->nama_pasien }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label>Poli</label>
                                                            <select name="poli_id" class="form-control">
                                                                @foreach($polis as $poli)
                                                                <option value="{{ $poli->id }}" {{ $rekammedis->poli_id == $poli->id ? 'selected' : '' }}>
                                                                    {{ $poli->nama_poli }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Dokter</label>
                                                            <select name="dokter_id" class="form-control" required>
                                                                @foreach($dokters as $dokter)
                                                                <option value="{{ $dokter->id }}" {{ $rekammedis->dokter_id == $dokter->id ? 'selected' : '' }}>
                                                                    {{ $dokter->nama_dokter }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Keluhan</label>
                                                            <input type="text" name="keluhan" class="form-control" value="{{ $rekammedis->keluhan }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Resep Obat</label>
                                                            <input type="text" name="resep_obat" class="form-control" value="{{ $rekammedis->resep_obat }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Penyakit</label>
                                                            <input type="text" name="penyakit" class="form-control" value="{{ $rekammedis->penyakit }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success">Simpan Perubahan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
            autocompleteInput('nama_pasien', 'list_pasien', 'pasien_id', '/autocompleterekammedis/pasien');
            autocompleteInput('nama_poli', 'list_poli', 'poli_id', '/autocompleterekammedis/poli');
            autocompleteInput('nama_dokter', 'list_dokter', 'dokter_id', '/autocompleterekammedis/dokter');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
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