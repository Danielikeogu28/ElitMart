<nav class="navbar navbar-expand-lg main_menu">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Freeit" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fa-solid fa-house me-2"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fa-solid fa-circle-info me-2"></i>About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('service') ? 'active' : '' }}"
                        href="{{ route('service') }}">
                        <i class="fa-solid fa-truck-fast me-2"></i>Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('portfolio') ? 'active' : '' }}"
                        href="{{ route('portfolio') }}">
                        <i class="fa-solid fa-briefcase me-2"></i>Portfolio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">
                        <i class="fa-solid fa-cart-shopping me-2"></i>Shop
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}"
                        href="{{ route('blog') }}">Blog</a>
                </li>

            </ul>
            <ul class="right_menu d-flex flex-wrap align-items-center">
                <li>
                    <a href="{{ route('cart-checkout')}}" class="wsus__manu_cart icon">
                        <span>
                            <img src="{{ asset('assets/images/cart_icon_black.svg') }}" alt="cart"
                                class="img-fluid">
                            <b class="cart-count">{{ count(Session::get('cart', [])) }}</b>
                        </span>
                    </a>
                </li>
                <li>
                    @auth
                        <a href="{{ route('profile.edit') }}"
                            class="common_btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300"><i
                                class="fa-solid fa-user"></i> Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit"
                                class="common_btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Logout</button>
                        </form>
                    @else
                        <form method="GET" action="{{ route('login') }}" style="display: inline;">
                            @csrf
                            <button type="submit"
                                class="common_btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Login</button>
                        </form>
                        <a href="{{ route('register') }}"
                            class="common_btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Sign
                            Up</a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let navLinks = document.querySelectorAll(".navbar-nav .nav-link");

            navLinks.forEach(link => {
                link.addEventListener("click", function() {
                    // Remove active class from all links
                    navLinks.forEach(nav => nav.classList.remove("active"));

                    // Add active class to the clicked link
                    this.classList.add("active");
                });
            });
        });
    </script>

</nav>
