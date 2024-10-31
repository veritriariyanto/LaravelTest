<!-- resources/views/components/sidebar.blade.php -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('pakets.index') }}">
                    <i class="fas fa-box"></i> Paket
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('destinations.index') }}">
                    <i class="fas fa-map-marker-alt"></i> Destinations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('transports.index') }}">
                    <i class="fas fa-bus"></i> Transports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('hotels.index') }}">
                    <i class="fas fa-hotel"></i> Hotel
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-light bg-transparent border-0" style="cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
