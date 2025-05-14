<header>
    <div class="navbar">
        <div class="nav-logo border">
            <div class="logo"></div>
        </div>
        
        <div class="nav-address border">
            <p class="add-first">Deliver to</p>
            <div class="add-icon">
                <i class="fas fa-map-marker-alt"></i>
                <p class="add-second">India</p>
            </div>
        </div>
        
        <div class="nav-search">
            <select class="search-select">
                <option>All</option>
                @foreach($categories as $category)
                    <option>{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="text" placeholder="Search Amazon" class="search-input">
            <button class="search-icon">
                <i class="fas fa-search"></i>
            </button>
        </div>
        
        <div class="nav-signin border">
            @auth
                <p><span>Hello, {{ Auth::user()->name }}</span></p>
                <p class="nav-second">Account & Lists</p>
            @else
                <p><span>Hello, Sign in</span></p>
                <p class="nav-second">Account & Lists</p>
            @endauth
        </div>
        
        <div class="nav-return border">
            <p><span>Returns</span></p>
            <p class="nav-second">& Orders</p>
        </div>
        
        <div class="nav-cart border">
            <i class="fas fa-shopping-cart"></i>
            Cart
            <span class="cart-count">{{ Cart::count() }}</span>
        </div>
    </div>
    
    <!-- Mobile Navigation -->
    <div class="mobile-navbar">
        <div class="mobile-menu-btn">
            <i class="fas fa-bars"></i>
            <span>All</span>
        </div>
        <div class="mobile-search">
            <input type="text" placeholder="Search Amazon">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="mobile-cart">
            <i class="fas fa-shopping-cart"></i>
        </div>
    </div>
    
    <!-- Panel -->
    <div class="panel">
        <div class="panel-all">
            <i class="fas fa-bars"></i>
            All
        </div>
        <div class="panel-ops">
            <p>Today's Deals</p>
            <p>Customer Service</p>
            <p>Registry</p>
            <p>Gift Cards</p>
            <p>Sell</p>
        </div>
        <div class="panel-deals">
            Shop deals in Electronics
        </div>
    </div>
</header>