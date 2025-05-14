<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Clone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/usercss/style.css') }}">
</head>
<body>
    <!-- Header/Navbar -->
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
                    <option>Electronics</option>
                    <option>Books</option>
                    <option>Home</option>
                </select>
                <input type="text" placeholder="Search Amazon" class="search-input">
                <button class="search-icon">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div class="nav-signin border">
                <p><span>Hello, Sign in</span></p>
                <p class="nav-second">Account & Lists</p>
            </div>
            
            <div class="nav-return border">
                <p><span>Returns</span></p>
                <p class="nav-second">& Orders</p>
            </div>
            
            <div class="nav-cart border">
                <i class="fas fa-shopping-cart"></i>
                Cart
                <span class="cart-count">0</span>
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
    
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-msg">
            <p>You are on amazon.com. You can also shop on Amazon India for millions of products with fast local delivery. <a href="#">Click here to go to amazon.in</a></p>
        </div>
    </div>
    
    <!-- Shop Section -->
    <div class="shop-section">
        <div class="box">
            <div class="box-content">
                <h2>Clothes</h2>
                <div class="box-img" style="background-image: url('images/box1_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <h2>Health & Personal Care</h2>
                <div class="box-img" style="background-image: url('images/box2_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <h2>Furniture</h2>
                <div class="box-img" style="background-image: url('images/box3_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <h2>Electronics</h2>
                <div class="box-img" style="background-image: url('images/box4_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <h2>Beauty picks</h2>
                <div class="box-img" style="background-image: url('images/box5_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <h2>Pet Care</h2>
                <div class="box-img" style="background-image: url('images/box6_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <h2>New Arrivals in Toys</h2>
                <div class="box-img" style="background-image: url('images/box7_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <h2>Discover Fasion Trends</h2>
                <div class="box-img" style="background-image: url('images/box8_image.jpg');"></div>
                <p>See more</p>
            </div>
        </div>
    </div>
    
    <!-- Product Grid -->
    <section class="product-section">
        <h2>Featured Products</h2>
        <div class="product-grid" id="productGrid">
            <!-- Products will be loaded here via JavaScript -->
        </div>
    </section>
    
    <!-- Footer -->
    <footer>
        <div class="foot-panel1">
            Back to Top
        </div>
        
        <div class="foot-panel2">
            <ul>
                <h3>Get to Know Us</h3>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About Amazon</a></li>
                <li><a href="#">Investor Relations</a></li>
                <li><a href="#">Amazon Devices</a></li>
            </ul>
            <ul>
                <h3>Make Money with Us</h3>
                <li><a href="#">Sell products on Amazon</a></li>
                <li><a href="#">Sell on Amazon Business</a></li>
                <li><a href="#">Become an Affiliate</a></li>
                <li><a href="#">Advertise Your Products</a></li>
                <li><a href="#">Self-Publish with Us</a></li>
            </ul>
            <ul>
                <h3>Amazon Payment Products</h3>
                <li><a href="#">Amazon Business Card</a></li>
                <li><a href="#">Shop with Points</a></li>
                <li><a href="#">Reload Your Balance</a></li>
                <li><a href="#">Amazon Currency Converter</a></li>
            </ul>
            <ul>
                <h3>Let Us Help You</h3>
                <li><a href="#">Amazon and COVID-19</a></li>
                <li><a href="#">Your Account</a></li>
                <li><a href="#">Your Orders</a></li>
                <li><a href="#">Shipping Rates & Policies</a></li>
                <li><a href="#">Returns & Replacements</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </div>
        
        <div class="foot-panel3">
            <div class="logo"></div>
            <div class="language-selector">
                <i class="fas fa-globe"></i>
                <select>
                    <option>English</option>
                    <option>Español</option>
                    <option>Français</option>
                    <option>Deutsch</option>
                </select>
            </div>
        </div>
        
        <div class="foot-panel4">
            <div class="pages">
                <a href="#">Conditions of Use</a>
                <a href="#">Privacy Notice</a>
                <a href="#">Your Ads Privacy Choices</a>
            </div>
            <div class="copyright">
                © 1996-2023, Amazon.com, Inc. or its affiliates
            </div>
        </div>
    </footer>
    
    <!-- Shopping Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>Your Shopping Cart</h3>
            <button class="close-cart">&times;</button>
        </div>
        <div class="cart-items" id="cartItems">
            <!-- Cart items will be added here -->
        </div>
        <div class="cart-total">
            <p>Subtotal (<span id="cartItemCount">0</span> items): <span id="cartTotal">$0.00</span></p>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>
    
    <script src="{{ asset('frontend/userjs/script.js') }}"></script>
</body>
</html>