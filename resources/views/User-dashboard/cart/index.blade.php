@extends('layouts.app')

@section('title', 'Your Shopping Cart - Amazon Clone')

@section('content')
    <div class="cart-page">
        <div class="cart-header">
            <h1>Your Shopping Cart</h1>
            <a href="{{ route('products.index') }}" class="continue-shopping">Continue Shopping</a>
        </div>
        
        @if(Cart::count() > 0)
            <div class="cart-items">
                <div class="cart-column-headers">
                    <div class="column-product">Product</div>
                    <div class="column-price">Price</div>
                    <div class="column-quantity">Quantity</div>
                    <div class="column-total">Total</div>
                </div>
                
                @foreach(Cart::content() as $item)
                    <div class="cart-item">
                        <div class="column-product">
                            <img src="{{ $item->model->image }}" alt="{{ $item->model->name }}" class="cart-item-image">
                            <div class="cart-item-details">
                                <a href="{{ route('products.show', $item->model->slug) }}" class="cart-item-title">{{ $item->model->name }}</a>
                                <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-item">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div class="column-price">
                            ${{ number_format($item->price, 2) }}
                        </div>
                        <div class="column-quantity">
                            <form action="{{ route('cart.update', $item->rowId) }}" method="POST" class="quantity-form">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="decrease" class="quantity-btn decrease">-</button>
                                <input type="text" class="quantity-input" value="{{ $item->qty }}" readonly>
                                <button type="submit" name="action" value="increase" class="quantity-btn increase">+</button>
                            </form>
                        </div>
                        <div class="column-total">
                            ${{ number_format($item->price * $item->qty, 2) }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="cart-summary">
                <div class="subtotal">
                    <span>Subtotal ({{ Cart::count() }} items):</span>
                    <span>${{ Cart::total() }}</span>
                </div>
                <div class="checkout-actions">
                    <a href="{{ route('checkout.index') }}" class="checkout-btn">Proceed to Checkout</a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <h2>Your Amazon Cart is empty</h2>
                <a href="{{ route('products.index') }}" class="shop-btn">Shop today's deals</a>
            </div>
        @endif
    </div>
@endsection