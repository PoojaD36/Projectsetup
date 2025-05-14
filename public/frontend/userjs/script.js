document.addEventListener('DOMContentLoaded', function() {
    // Sample product data
    const products = [
        {
            id: 1,
            title: 'Wireless Bluetooth Headphones',
            price: 59.99,
            rating: 4,
            image: 'https://m.media-amazon.com/images/I/51+AE5KjRlL._AC_UF1000,1000_QL80_.jpg'
        },
        {
            id: 2,
            title: 'Smart Watch with Fitness Tracker',
            price: 89.99,
            rating: 5,
            image: 'https://m.media-amazon.com/images/I/61S0a7x2yaL._AC_UF1000,1000_QL80_.jpg'
        },
        {
            id: 3,
            title: 'Portable External Hard Drive 1TB',
            price: 49.99,
            rating: 4,
            image: 'https://m.media-amazon.com/images/I/61LB+d0vheL._AC_UF1000,1000_QL80_.jpg'
        },
        {
            id: 4,
            title: 'Wireless Charging Stand',
            price: 29.99,
            rating: 3,
            image: 'https://m.media-amazon.com/images/I/61+Q6RhG+IL._AC_UF1000,1000_QL80_.jpg'
        },
        {
            id: 5,
            title: 'Noise Cancelling Headphones',
            price: 199.99,
            rating: 5,
            image: 'https://m.media-amazon.com/images/I/61CGHv6kmWL._AC_UF1000,1000_QL80_.jpg'
        },
        {
            id: 6,
            title: 'Smart Home Security Camera',
            price: 79.99,
            rating: 4,
            image: 'https://m.media-amazon.com/images/I/51E7Zq4qQ5L._AC_UF1000,1000_QL80_.jpg'
        },
        {
            id: 7,
            title: 'Electric Toothbrush with 3 Brush Heads',
            price: 39.99,
            rating: 4,
            image: 'https://m.media-amazon.com/images/I/61W5iSX1WVL._AC_UF1000,1000_QL80_.jpg'
        },
        {
            id: 8,
            title: '4K Ultra HD Smart TV 55"',
            price: 499.99,
            rating: 5,
            image: 'https://m.media-amazon.com/images/I/81+Q0ylQejL._AC_UF1000,1000_QL80_.jpg'
        }
    ];

    // Shopping cart
    let cart = [];
    const cartSidebar = document.getElementById('cartSidebar');
    const cartItemsContainer = document.getElementById('cartItems');
    const cartItemCount = document.querySelector('.cart-count');
    const cartTotalElement = document.getElementById('cartTotal');
    const cartItemCountElement = document.getElementById('cartItemCount');
    const overlay = document.createElement('div');
    overlay.className = 'overlay';
    document.body.appendChild(overlay);

    // Load products
    const productGrid = document.getElementById('productGrid');
    
    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        
        const stars = '★'.repeat(product.rating) + '☆'.repeat(5 - product.rating);
        
        productCard.innerHTML = `
            <img src="${product.image}" alt="${product.title}" class="product-image">
            <div class="product-info">
                <h3 class="product-title">${product.title}</h3>
                <div class="product-price">$${product.price.toFixed(2)}</div>
                <div class="product-rating">${stars}</div>
                <button class="add-to-cart" data-id="${product.id}">Add to Cart</button>
            </div>
        `;
        
        productGrid.appendChild(productCard);
    });

    // Add to cart functionality
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart')) {
            const productId = parseInt(e.target.getAttribute('data-id'));
            const product = products.find(p => p.id === productId);
            
            // Check if product is already in cart
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    ...product,
                    quantity: 1
                });
            }
            
            updateCart();
        }
        
        // Open cart
        if (e.target.classList.contains('nav-cart') || e.target.closest('.nav-cart') || 
            e.target.classList.contains('mobile-cart') || e.target.closest('.mobile-cart')) {
            openCart();
        }
        
        // Close cart
        if (e.target.classList.contains('close-cart') || e.target === overlay) {
            closeCart();
        }
        
        // Remove item from cart
        if (e.target.classList.contains('remove-item')) {
            const productId = parseInt(e.target.getAttribute('data-id'));
            cart = cart.filter(item => item.id !== productId);
            updateCart();
        }
        
        // Update quantity
        if (e.target.classList.contains('quantity-btn')) {
            const productId = parseInt(e.target.getAttribute('data-id'));
            const item = cart.find(item => item.id === productId);
            
            if (e.target.classList.contains('decrease')) {
                if (item.quantity > 1) {
                    item.quantity -= 1;
                } else {
                    cart = cart.filter(i => i.id !== productId);
                }
            } else if (e.target.classList.contains('increase')) {
                item.quantity += 1;
            }
            
            updateCart();
        }
    });

    // Update cart UI
    function updateCart() {
        // Update cart count in navbar
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartItemCount.textContent = totalItems;
        cartItemCountElement.textContent = totalItems;
        
        // Update cart items
        cartItemsContainer.innerHTML = '';
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Your cart is empty</p>';
        } else {
            cart.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.title}" class="cart-item-image">
                    <div class="cart-item-details">
                        <h4 class="cart-item-title">${item.title}</h4>
                        <div class="cart-item-price">$${(item.price * item.quantity).toFixed(2)}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn decrease" data-id="${item.id}">-</button>
                            <input type="text" class="quantity-input" value="${item.quantity}" readonly>
                            <button class="quantity-btn increase" data-id="${item.id}">+</button>
                        </div>
                        <div class="remove-item" data-id="${item.id}">Delete</div>
                    </div>
                `;
                
                cartItemsContainer.appendChild(cartItem);
            });
        }
        
        // Update total
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        cartTotalElement.textContent = `$${total.toFixed(2)}`;
    }

    // Open cart
    function openCart() {
        cartSidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close cart
    function closeCart() {
        cartSidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Mobile menu toggle (placeholder - would need more implementation)
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
        alert('Mobile menu would open here');
    });
});