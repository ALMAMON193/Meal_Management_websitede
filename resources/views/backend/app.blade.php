<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Nov 2024 15:49:14 GMT -->

<head>
    <!-- Meta Information -->
    <meta charset="utf-8" />
    <title>@yield('title', 'Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- Include custom styles -->
    @include('backend.partials.style')
</head>

<body>
    <!-- Begin page layout -->
    <div id="layout-wrapper">

        <!-- Include header -->
        @include('backend.partials.header')

        <!-- Include notifications -->
        @include('backend.partials.notification')

        <!-- Sidebar menu -->
        @include('backend.partials.sidebar')
        <!-- Left Sidebar End -->

        <!-- Vertical Overlay for mobile screens -->
        <div class="vertical-overlay"></div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <!-- End main content -->
    </div>
    <!-- End layout-wrapper -->

    <!-- Back to top button -->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <!-- Preloader animation -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!-- Include custom scripts -->
    @include('backend.partials.script')
</body>
</html>
