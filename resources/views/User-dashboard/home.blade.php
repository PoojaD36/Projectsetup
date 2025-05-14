@extends('layouts.app')

@section('title', 'Amazon Clone - Home')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-msg">
            <p>You are on amazon.com. You can also shop on Amazon India for millions of products with fast local delivery. <a href="#">Click here to go to amazon.in</a></p>
        </div>
    </div>
    
    <!-- Shop Section -->
    <div class="shop-section">
        @foreach($categories as $category)
        <div class="box">
            <div class="box-content">
                <h2>{{ $category->name }}</h2>
                <div class="box-img" style="background-image: url('{{ $category->image }}');"></div>
                <p>See more</p>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Product Grid -->
    <section class="product-section">
        <h2>Featured Products</h2>
        <div class="product-grid">
            @foreach($featuredProducts as $product)
                <div class="product-card">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">{{ $product->name }}</h3>
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
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="add-to-cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection