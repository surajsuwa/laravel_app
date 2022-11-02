<!DOCTYPE html>

<html lang="en">

<head>
    @include('includes.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('includes.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')

        <!-- Main Footer -->
        @include('includes.footer')
    </div>

    <!-- REQUIRED SCRIPTS -->
    @include('includes.script')
</body>

</html>
