<nav class="navbar navbar-expand-lg navbar-landing fixed-top is-sticky" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="{{asset('frontend/images/Screenshot_4-removebg-preview.png')}}" class="card-logo card-logo-dark logo-img" alt="logo dark">
            <img src="{{asset('frontend/images/Screenshot_4-removebg-preview.png')}}" class="card-logo card-logo-light logo-img" alt="logo light">
        </a>
        <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">About US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('home')}}">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Skills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">My Team</a>
                </li>
            </ul>

            <div class="">
                <a href="" class="btn btn-success">Connect Me</a>
            </div>
        </div>

    </div>
</nav>
<style>
    .navbar-landing {
        background-color: #F3F6F9;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand svg {
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover svg {
        transform: scale(1.05);
    }

    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;

        position: relative;
    }

    .nav-link.active {
        color: #152c5b;
    }

    .logo-img {
        height: 60px; /* Increased from 40px */
        width: auto;
        max-height: 60px; /* Increased from 40px */
        object-fit: contain;
    }

    @media (max-width: 991.98px) {
        .navbar-collapse {
            padding: 1rem 0;
        }

        .nav-link {
            margin: 0.25rem 0;
            padding: 0.5rem 1rem;
        }

        .btn-success {
            margin-top: 0.5rem;
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .logo-img {
            height: 40px;
        }
    }
</style>
