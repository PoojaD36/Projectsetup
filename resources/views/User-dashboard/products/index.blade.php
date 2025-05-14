@extends('layouts.app')

@section('title', 'Products - Amazon Clone')

@section('content')
    <section class="product-section">
        <div class="product-filters">
            <h2>{{ $category->name ?? 'All Products' }}</h2>
            <div class="filter-options">
                <select id="sort-by">
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="rating_desc">Avg. Customer Review</option>
                    <option value="newest">Newest Arrivals</option>
                </select>
            </div>
        </div>
        
        <div class="product-grid">
            @foreach($products as $product)
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
                            <span class="rating-count">({{ $product->reviews_count }})</span>
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="add-to-cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </section>
@endsection