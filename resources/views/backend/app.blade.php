<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1" />
    <title>Eastoz - Business Home</title>
    <!-- ==== Favicon ==== -->
    <link rel="icon" type="image/png" href="/" />

    <!-- ==== Plugins CSS Links ==== -->
    <link rel="stylesheet" type="text/css" href="frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/helper.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ==== Custom CSS Links ==== -->
    <link rel="stylesheet" type="text/css" href="frontend/css/somor.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/shohag.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/rodro.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/mamon.css" />
</head>

<body>
    <main class="business_layout business_home">
        @include('backend.partials.sidebar')
        <div class="business_layout_body_wrapper">
           @include('backend.partials.header')
           @yield('content')
        </div>
        <div id="black_overlay"></div>
    </main>

    <!-- footer end  -->
    <!-- footer end  -->

    <!-- ==== All Js Links ==== -->
    @include('backend.partials.script')
</body>

</html>
