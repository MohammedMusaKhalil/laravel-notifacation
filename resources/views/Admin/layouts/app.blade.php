<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Admin Dashbord</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
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
                        <div class="sb-sidenav-menu-heading">Pages</div>
                        <a class="nav-link" href="{{ route('admin.dashbord') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Users managment</div>
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            all Users
                        </a>
                        <a class="nav-link" href="{{ route('admin.users.enable') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            active Users
                        </a>
                        <a class="nav-link" href="{{ route('admin.users.banned') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Banned Users
                        </a>
                        <a class="nav-link" href="{{ route('admin.users.email') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Email Unverified Users
                        </a>
                        <a class="nav-link" href="{{ route('admin.users.phone') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Phone Unverified Users
                        </a>
                        <a class="nav-link" href="{{ route('admin.dashbord.send') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Send Notification
                        </a>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"
        integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
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
</body>

</html>
