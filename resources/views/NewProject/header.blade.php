<!-- Top Header -->
<header class="top-header">
    <button class="mobile-menu-toggle">
        <i class="fas fa-bars"></i>
    </button>
    <div class="mobile-logo">
        <i class="fas fa-chart-pie"></i>
        <span>DashUI</span>
    </div>
    <div class="mobile-user-menu">
        <button class="mobile-user-btn">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="mobile-user-img">
            <i class="fas fa-caret-down"></i>
        </button>
        <div class="mobile-dropdown">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</header>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay"></div>