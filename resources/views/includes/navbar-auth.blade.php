<nav
            class="
                navbar navbar-expand-lg navbar-light navbar-store
                fixed-top
                navbar-fixed-top
            "
            data-aos="fade-down"
        >
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img
                        src="/images/farming.svg"
                        alt="logo"
                        width="45px"
                        height="51px"
                    />
                </a>
                <div class="mt-3">
                    <p style="font-family: 'EB Garamond', serif;">
                           Farmers Marketplace Indonesia
                </p>
                </div>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories') }}" class="nav-link"
                                >Categories</a
                            >
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Rewards</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>