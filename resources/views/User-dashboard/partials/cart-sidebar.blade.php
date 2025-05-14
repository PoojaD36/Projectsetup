<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h3>Your Shopping Cart</h3>
        <button class="close-cart">&times;</button>
    </div>
    <div class="cart-items">
        @if(Cart::count() > 0)
            @foreach(Cart::content() as $item)
                <div class="cart-item">
                    <img src="{{ $item->model->image }}" alt="{{ $item->model->name }}" class="cart-item-image">
                    <div class="cart-item-details">
                        <h4 class="cart-item-title">{{ $item->model->name }}</h4>
                        <div class="cart-item-price">${{ number_format($item->price * $item->qty, 2) }}</div>
                        <div class="cart-item-quantity">
                            <form action="{{ route('cart.update', $item->rowId) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="decrease" class="quantity-btn decrease">-</button>
                                <input type="text" class="quantity-input" value="{{ $item->qty }}" readonly>
                                <button type="submit" name="action" value="increase" class="quantity-btn increase">+</button>
                            </form>
                        </div>
                        <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-item">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p>Your cart is empty</p>
        @endif
    </div>
    <div class="cart-total">
        <p>Subtotal ({{ Cart::count() }} items): <span id="cartTotal">${{ Cart::total() }}</span></p>
        <a href="{{ route('checkout.index') }}" class="checkout-btn">Proceed to Checkout</a>
    </div>
</div>

<div class="overlay" id="overlay"></div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cart toggle functionality
        const cartSidebar = document.getElementById('cartSidebar');
        const overlay = document.getElementById('overlay');
        
        // Open cart
        document.querySelectorAll('.nav-cart, .mobile-cart').forEach(el => {
            el.addEventListener('click', function() {
                cartSidebar.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });
        
        // Close cart
        document.querySelector('.close-cart').addEventListener('click', function() {
            cartSidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        overlay.addEventListener('click', function() {
            cartSidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
</script>
@endpush