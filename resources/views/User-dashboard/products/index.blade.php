@extends('comman.layout')
@section('title', 'Products')
@section('content')
    <div class="content-wrapper">
        <!-- Header Section -->
        <header class="ecommerce-header">
            <div class="header-container">
                <div class="logo">ShopEase</div>
                <div class="search-bar">
                    <form method="GET" action="{{ route('user-product-view') }}">
                        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="header-actions">
                    <a href="{{ route('user-product-cart') }}" class="cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        {{-- Cart <span class="cart-count">{{ Cart::count() }}</span> --}}
                    </a>
                    <form method="POST" action="{{ route('userLogout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="products-main">
            <div class="main-container">
                <h1 class="page-title">Our Products</h1>

                <!-- Filter Section -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('user-product-view') }}" id="filterForm">
                        <div class="category-filter">
                            <label for="category">Category:</label>
                            <select id="category" name="category">
                                <option value="all">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sort-filter">
                            <label for="sort">Sort By:</label>
                            <select id="sort" name="sort">
                                <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- Products Grid -->
                <div class="products-grid">
                    @forelse($products as $product)
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                @if($product->status == 'active')
                                    <span class="product-badge">Available</span>
                                @else
                                    <span class="product-badge out-of-stock">Out of Stock</span>
                                @endif
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <div class="product-category">{{ $product->category->name }}</div>
                                <div class="product-price">
                                    <span class="current-price">₹{{ number_format($product->price, 2) }}</span>
                                </div>
                                <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                                <form class="add-to-cart-form" action="{{ route('user-product-cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="add-to-cart" {{ $product->status != 'active' ? 'disabled' : '' }}>
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="no-products">
                            <p>No products found. Please try different search or filter criteria.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                {{-- @if($products->hasPages())
                    <div class="pagination">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @endif --}}
            </div>
        </main>

        <!-- Footer -->
        <footer class="ecommerce-footer">
            <div class="footer-container">
                <div class="footer-about">
                    <div class="footer-logo">ShopEase</div>
                    <p>Your one-stop shop for all your needs. We offer high-quality products at competitive prices with excellent customer service.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="{{ route('user-product-view') }}">Home</a></li>
                        <li><a href="{{ route('user-product-view') }}">Products</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Categories</h3>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{ route('user-product-view', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, City, Country</p>
                        <p><i class="fas fa-phone"></i> +1 234 567 890</p>
                        <p><i class="fas fa-envelope"></i> info@shopease.com</p>
                    </div>
                </div>
            </div>
            <div class="copyright">
                &copy; {{ date('Y') }} ShopEase. All Rights Reserved.
            </div>
        </footer>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/usercss/products.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('frontend/userjs/products.js') }}"></script>
@endsection