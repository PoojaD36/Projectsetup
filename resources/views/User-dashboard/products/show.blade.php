@extends('layouts.app')

@section('title', $product->name . ' - Amazon Clone')

@section('content')
    <div class="product-detail-container">
        <div class="product-images">
            <div class="main-image">
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
            </div>
            <div class="thumbnail-images">
                @foreach($product->images as $image)
                    <img src="{{ $image->url }}" alt="{{ $product->name }}">
                @endforeach
            </div>
        </div>
        
        <div class="product-info">
            <h1>{{ $product->name }}</h1>
            <div class="product-rating">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $product->rating)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
                <a href="#reviews" class="rating-count">{{ $product->reviews_count }} ratings</a>
            </div>
            
            <hr>
            
            <div class="product-price">
                <span class="price">${{ number_format($product->price, 2) }}</span>
                <span class="shipping">+ ${{ number_format($product->shipping_cost, 2) }} Shipping</span>
            </div>
            
            <div class="product-description">
                <h3>About this item</h3>
                <p>{{ $product->description }}</p>
                <ul>
                    @foreach($product->features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
            
            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="quantity-selector">
                    <label for="quantity">Quantity:</label>
                    <select name="quantity" id="quantity">
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                <button type="button" class="buy-now-btn">Buy Now</button>
            </form>
        </div>
    </div>
    
    <section class="product-reviews" id="reviews">
        <h2>Customer reviews</h2>
        <div class="review-summary">
            <div class="average-rating">
                <span class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($product->rating))
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </span>
                <span class="average">{{ number_format($product->rating, 1) }} out of 5</span>
            </div>
            <div class="rating-distribution">
                @for($i = 5; $i >= 1; $i--)
                    <div class="rating-bar">
                        <span class="star-count">{{ $i }} star</span>
                        <div class="bar-container">
                            <div class="bar" style="width: {{ ($product->reviews->where('rating', $i)->count() / max($product->reviews_count, 1)) * 100 }}%"></div>
                        </div>
                        <span class="percentage">{{ round(($product->reviews->where('rating', $i)->count() / max($product->reviews_count, 1)) * 100) }}%</span>
                    </div>
                @endfor
            </div>
        </div>
        
        <div class="review-list">
            @foreach($product->reviews as $review)
                <div class="review">
                    <div class="review-header">
                        <span class="reviewer">{{ $review->user->name }}</span>
                        <span class="review-date">{{ $review->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="review-rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <h3 class="review-title">{{ $review->title }}</h3>
                    <p class="review-body">{{ $review->body }}</p>
                </div>
            @endforeach
        </div>
    </section>
    
    <section class="related-products">
        <h2>Customers who viewed this item also viewed</h2>
        <div class="product-grid">
            @foreach($relatedProducts as $product)
                <div class="product-card">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                    </a>
                    <div class="product-info">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <h3 class="product-title">{{ $product->name }}</h3>
                        </a>
                        <div class="product-price">${{ number_format($product->price, 2) }}</div>
                        <div class="product-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $product->rating)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('styles')
<style>
    .product-detail-container {
        display: flex;
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .product-images {
        flex: 1;
    }
    
    .product-info {
        flex: 1;
    }
    
    /* Add more specific styles as needed */
</style>
@endpush