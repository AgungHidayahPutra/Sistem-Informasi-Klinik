<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard | Resepsionis</title>
    <link rel="icon" href="{{ asset('assets/images/logo-klinik.svg') }}" type="image/svg+xml" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

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
                        <a class="nav-link text-lavender active" href="/dashboard">
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
                        <a class="nav-link text-lavender" href="/pembayaran">
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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    Dokter Tersedia: {{ $jumlahTersedia }}
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/dokter">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <!-- Warning Card (Sedang Diperiksa) -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    Antrian Sedang Diperiksa: {{ $jumlahSedangDiperiksa }}
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/antrian">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <!-- Danger Card (Menunggu) -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    Antrian Menunggu: {{ $jumlahMenunggu }}
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/antrian">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Rekam Medis per Bulan
                                </div>
                                <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;"><canvas id="myBarChart"></canvas></div>
                                <div class="card-footer small text-muted">Updated recently</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Data Poli Berdasarkan Rekam Medis
                                </div>
                                <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;"><canvas id="myPieChart"></canvas></div>
                                <div class="card-footer small text-muted">Updated recentlyM</div>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart (sudah kamu punya)
        const pieLabels = @json($labels);
        const pieData = @json($counts);

        new Chart(document.getElementById("myPieChart"), {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieData,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                }],
            }
        });

        // Bar Chart
        const barLabels = @json($bulanLabels);
        const barData = @json($jumlahPerBulan);

        new Chart(document.getElementById("myBarChart"), {
            type: 'bar',
            data: {
                labels: barLabels,
                datasets: [{
                    label: 'Jumlah RME per Bulan',
                    backgroundColor: "#4e73df",
                    borderColor: "#4e73df",
                    data: barData,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // supaya tidak ada koma
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>
</body>

</html>