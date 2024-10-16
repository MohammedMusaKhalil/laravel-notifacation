<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.0.2/build/global/luxon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.0.0"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Admin Dashboard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Dashboard Links -->
                        <a class="nav-link" href="{{ route('admin.dashbord') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('admin.dashbord.User_statistics') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Users Statistics
                        </a>
                        <!-- Notifications Section -->
                        <a class="nav-link" href="{{ route('admin.dashbord.send') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                            Send Notification
                        </a>
                        <a class="nav-link" href="{{ route('admin.dashbord.Users_messages') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                            Notificaction Is Sent
                        </a>
                        <a class="nav-link" href="{{ route('admin.dashbord.daily.tips') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-lightbulb"></i></div>
                            Daily Advice
                        </a>

                        <!-- User Management Section -->
                        <div class="sb-sidenav-menu-heading">Users Management</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Manage Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">All Users</a>
                                <a class="nav-link" href="{{ route('admin.users.enable') }}">Active Users</a>
                                <a class="nav-link" href="{{ route('admin.users.banned') }}">Banned Users</a>
                                <a class="nav-link" href="{{ route('admin.users.email') }}">Email Verified Users</a>
                                <a class="nav-link" href="{{ route('admin.users.phone') }}">Phone Verified Users</a>
                            </nav>
                        </div>

                        <!-- Horoscope Management Section -->
                        <div class="sb-sidenav-menu-heading">HOROSCOPE MANAGEMENT</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHoroscope" aria-expanded="false" aria-controls="collapseHoroscope">
                            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                            Manage Horoscope
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseHoroscope" aria-labelledby="headingHoroscope" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.daily.horoscope') }}">Daily Horoscope </a>
                            </nav>
                        </div>
                        <div class="collapse" id="collapseHoroscope" aria-labelledby="headingHoroscope" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.weekly.horoscope') }}">Weekly Horoscope </a>
                            </nav>
                        </div>

                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            @yield('content')
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap and JS libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js')}}"></script>

    <script>
        // Sidebar toggle for small screens
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.getElementById('sidebarToggle');
            sidebarToggle.addEventListener('click', function () {
                document.body.classList.toggle('sb-sidenav-toggled');
            });
        });

        // Mark as Read Notifications
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('admin.markNotification') }}", {
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                }
            });
        }

        $(function() {
            $('.mark-as-read').click(function(e) {
                e.preventDefault();
                let request = sendMarkRequest($(this).data('id'));

                request.done(() => {
                    $(this).parents('div.alert').remove();
                });
            });

            $('#mark-all').click(function(e) {
                e.preventDefault();
                let request = sendMarkRequest();

                request.done(() => {
                    $('div.alert').remove();
                })
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
