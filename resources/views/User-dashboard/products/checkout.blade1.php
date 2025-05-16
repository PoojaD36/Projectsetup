@extends('comman.layout')
@section('title', 'Checkout')
@section('content')
    <div class="content-wrapper">
        <!-- Header Section -->
        <header class="ecommerce-header">
            <div class="header-container">
                <div class="logo">ShopEase</div>
                <div class="header-actions">
                    <a href="{{ route('user-product-view') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Back to Cart
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

        <!-- Checkout Content -->
        <main class="checkout-main">
            <div class="main-container">
                <h1 class="page-title">Checkout</h1>
                
                <div class="checkout-container">
                    <!-- Shipping Address -->
                    <div class="checkout-section">
                        <h2 class="section-title">
                            <i class="fas fa-map-marker-alt"></i> Shipping Address
                        </h2>
                        <form id="addressForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" id="city" name="city" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="zip_code">ZIP Code</label>
                                    <input type="text" id="zip_code" name="zip_code" required>
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select id="country" name="country" required>
                                        <option value="India">India</option>
                                        <option value="USA">United States</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="Canada">Canada</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-section">
                        <h2 class="section-title">
                            <i class="fas fa-credit-card"></i> Payment Method
                        </h2>
                        <div class="payment-methods">
                            <div class="payment-method active" data-method="credit">
                                <i class="far fa-credit-card"></i>
                                <span>Credit Card</span>
                            </div>
                            <div class="payment-method" data-method="paypal">
                                <i class="fab fa-cc-paypal"></i>
                                <span>PayPal</span>
                            </div>
                            <div class="payment-method" data-method="upi">
                                <i class="fas fa-mobile-alt"></i>
                                <span>UPI</span>
                            </div>
                        </div>

                        <!-- Credit Card Form -->
                        <div class="payment-form" id="creditCardForm">
                            <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input type="text" id="card_number" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="form-group">
                                <label for="card_name">Name on Card</label>
                                <input type="text" id="card_name" placeholder="John Doe">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="text" id="expiry_date" placeholder="MM/YY">
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" placeholder="123">
                                </div>
                            </div>
                        </div>

                        <!-- PayPal Form (hidden by default) -->
                        <div class="payment-form" id="paypalForm" style="display: none;">
                            <p>You will be redirected to PayPal to complete your payment</p>
                        </div>

                        <!-- UPI Form (hidden by default) -->
                        <div class="payment-form" id="upiForm" style="display: none;">
                            <div class="form-group">
                                <label for="upi_id">UPI ID</label>
                                <input type="text" id="upi_id" placeholder="yourname@upi">
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="checkout-section order-summary">
                        <h2 class="section-title">
                            <i class="fas fa-receipt"></i> Order Summary
                        </h2>
                        <div class="order-items">
                            @foreach(Cart::content() as $item)
                                <div class="order-item">
                                    <div class="item-image">
                                        <img src="{{ asset($item->model->image) }}" alt="{{ $item->model->name }}">
                                    </div>
                                    <div class="item-details">
                                        <h4>{{ $item->model->name }}</h4>
                                        <div class="item-price">₹{{ number_format($item->price, 2) }}</div>
                                        <div class="item-quantity">Qty: {{ $item->qty }}</div>
                                    </div>
                                    <div class="item-subtotal">₹{{ number_format($item->price * $item->qty, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-totals">
                            <div class="total-row">
                                <span>Subtotal:</span>
                                <span>₹{{ number_format(Cart::subtotal(), 2) }}</span>
                            </div>
                            <div class="total-row">
                                <span>Shipping:</span>
                                <span>₹{{ number_format($shipping = 50, 2) }}</span>
                            </div>
                            <div class="total-row">
                                <span>Tax ({{ config('cart.tax') }}%):</span>
                                <span>₹{{ number_format(Cart::tax(), 2) }}</span>
                            </div>
                            <div class="total-row grand-total">
                                <span>Total:</span>
                                <span>₹{{ number_format(Cart::total() + $shipping, 2) }}</span>
                            </div>
                        </div>
                        <button type="button" id="placeOrderBtn" class="place-order-btn">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/usercss/products.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('frontend/userjs/products.js') }}"></script>
@endsection