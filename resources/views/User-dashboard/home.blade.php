@extends('User-dashboard.layouts.layout')
@section('title', 'Products')
@section('content') 


    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="mb-4">Our Products</h1>
        <!-- Filter Form -->
        <form method="POST" action="{{ route('user-product-view') }}">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="category_id">Category</label>
                        <select class="form-select" name="category_id" id="category_id" onchange="this.form.submit()">
                            <option value="all">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="sort">Sort By</label>
                        <select class="form-select" name="sort" id="sort" onchange="this.form.submit()">
                            <option value="default">Default</option>
                            <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low
                                to High</option>
                            <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price:
                                High to Low</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <!-- Products Grid -->
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->category->name }}</p> <!-- Show category name -->
                            <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text mb-0">₹{{ number_format($product->price, 2) }}</p>
                                {{-- <button class="btn btn-primary add-to-cart-btn" data-product-id="{{ $product->id }}">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button> --}}
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No products found in this category.</div>
                </div>
            @endforelse
        </div>

        <!-- Pagination with filters -->
        {{-- @if ($products->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>
@endif --}}
    </div>




    <!-- JavaScript -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your custom JS -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap modals
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

            // Cart button click handler
            document.getElementById('cartBtn').addEventListener('click', function() {
                cartModal.show();
                loadCartItems();
            });

            // Checkout button click handler
            document.getElementById('checkoutBtn').addEventListener('click', function() {
                cartModal.hide();
                paymentModal.show();
            });

            // Add to cart buttons
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    addToCart(productId);
                });
            });

            function addToCart(productId) {
                fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartCount(data.cartCount);
                            // Show success toast or alert
                            const toast = new bootstrap.Toast(document.createElement('div'));
                            toast._element.className = 'toast align-items-center text-white bg-success';
                            toast._element.innerHTML = `
                            <div class="d-flex">
                                <div class="toast-body">
                                    Product added to cart!
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        `;
                            document.body.appendChild(toast._element);
                            toast.show();

                            // Remove toast after it hides
                            toast._element.addEventListener('hidden.bs.toast', function() {
                                document.body.removeChild(toast._element);
                            });
                        }
                    });
            }

            function loadCartItems() {
                fetch('/cart/items')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('cartItems').innerHTML = data.html;
                        document.getElementById('subtotal').textContent = '₹' + data.subtotal.toFixed(2);
                        document.getElementById('total').textContent = '₹' + (data.subtotal + 5).toFixed(2);
                    });
            }

            function updateCartCount(count) {
                document.querySelector('.cart-count').textContent = count;
            }

            // Payment method selection
            document.querySelectorAll('.payment-method').forEach(method => {
                method.addEventListener('click', function() {
                    document.querySelectorAll('.payment-method').forEach(m => m.classList.remove(
                        'active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endsection
