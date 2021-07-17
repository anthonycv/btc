<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BTC Live price</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="https://logos-marcas.com/wp-content/uploads/2020/08/Bitcoin-Logo.png" rel="icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    @yield('counter')
</header><!-- End #header -->

<main id="main"><!-- End #main -->
    <!-- ======= About Us Section ======= -->
    <section>
        @yield('About Us')
    </section><!-- End About Us Section Section -->
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@yield('scripts')
</body>
</html>

