
<header>
        <div class="header-container">
            <div class="logo"><a href="{{ route('user-product-view') }}">ShopEase</a></div>
            <div class="search-bar">
                <input type="text" placeholder="Search products...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="header-actions">
                <button class="cart-btn">
    <a href="{{ route('show-cart') }}">
        <i class="fas fa-shopping-cart"></i>
        Cart <span class="cart-count">{{ auth()->check() ? auth()->user()->cart()->count() : 0 }}</span>
    </a>
</button>
              
                <button class="logout-btn"><a href="{{ route('userLogout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a></button>
            </div>
        </div>
    </header>
     <div class="container my-5">