

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
            <a href="{{ route('userLogout') }}" class="logout-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</header>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay"></div>

<!-- Sidebar Navigation -->
<aside class="sidebar">
    <nav class="sidebar-menu">
        <ul>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard_home') }}" class="welcome-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('categories') ? 'active' : '' }}">
                <a href="{{ route('Categorylist') }}" class="category-link">
                    <i class="fas fa-layer-group"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="{{ Request::is('subcategories') ? 'active' : '' }}">
                <a href="{{ route('subcategory-view') }}" class="subcategory-link">
                    <i class="fas fa-tags"></i>
                    <span>Subcategories</span>
                </a>
            </li>
            <li class="{{ Request::is('products') ? 'active' : '' }}">
                <a href="{{ route('product-view') }}" class="product-link">
                    <i class="fas fa-tags"></i>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <div class="user-profile">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
            <div class="user-info">
                <span class="user-name">Sarah Johnson</span>
                <span class="user-role">Admin</span>
            </div>
        </div>
        <a href="{{ route('userLogout') }}" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>
