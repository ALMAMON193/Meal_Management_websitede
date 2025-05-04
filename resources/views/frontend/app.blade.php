<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1" />
    <title>Eastoz - Home</title>
    <!-- ==== Favicon ==== -->
    <link rel="icon" type="image/png" href="/" />

    <!-- ==== Plugins CSS Links ==== -->
    <link rel="stylesheet" type="text/css" href="frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/helper.css" />
    <!-- ==== Custom CSS Links ==== -->
    @include('frontend.partials.style')
</head>

<body>
    <!-- Start Navbar  -->
    @include('frontend.partials.nav')
    <!-- End Navbar  -->

   @yield('content')

    <!-- footer start  -->
    <!-- footer start  -->
   @include('frontend.partials.footer')

    <!-- footer end  -->
    <!-- footer end  -->

    <!-- ==== All Js Links ==== -->
    <script>
        const currentYear = new Date().getFullYear();
        document.getElementById("current_year").textContent = currentYear;
    </script>
    @include('frontend.partials.script')
</body>

</html>
