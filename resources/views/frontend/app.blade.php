
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/job-landing.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Nov 2024 15:57:41 GMT -->
<head>

        <meta charset="utf-8" />
        <title>Job Landing | Velzon - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

       @include('frontend.partials.style')

    </head>

    <body data-bs-spy="scroll" data-bs-target="#navbar-example">

        <!-- Begin page -->
      @yield('content')
        <!-- end layout wrapper -->
      @include('frontend.partials.script')
    </body>


<!-- Mirrored from themesbrand.com/velzon/html/master/job-landing.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Nov 2024 15:57:45 GMT -->
</html>
