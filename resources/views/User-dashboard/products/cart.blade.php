@extends('User-dashboard.layouts.layout')
@section('title', 'Cart')
@section('content')


    <div class="cart-container">
        <!-- Cart Items Section -->
        <div class="card cart-card">
            <div class="card-header cart-header">
                <h3 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Your Shopping Cart</h3>
            </div>
            <div class="card-body">
                @if ($cartItems->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x mb-4" style="color: #dddfeb;"></i>
                        <h4 class="mb-3">Your cart is empty</h4>
                        <a href="{{ route('user-product-view') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr class="cart-item">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('' . $item->product->image) }}"
                                                    alt="{{ $item->product->name }}" class="product-img me-3">
                                                <div>
                                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">{{ $item->product->category->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>₹{{ number_format($item->product->price, 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group" style="width: 140px;">
                                                    <button class="quantity-btn" type="submit" name="action"
                                                        value="decrease">-</button>
                                                    <input type="number" class="form-control quantity-input"
                                                        name="quantity" value="{{ $item->quantity }}" min="1">
                                                    <button class="quantity-btn" type="submit" name="action"
                                                        value="increase">+</button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="remove-btn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        {{-- <div class="col-md-6">
                            <div class="summary-card">
                                <h5 class="section-title">Order Summary</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>₹{{ number_format($subtotal, 2) }}</span>
                                </div>
                                @if ($discount > 0)
                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <span>Discount:</span>
                                    <span>-₹{{ number_format($discount, 2) }}</span>
                                </div>
                                @endif
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Shipping:</span>
                                    <span>₹{{ number_format($shipping, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-5 mt-3 pt-2 border-top">
                                    <span>Total:</span>
                                    <span>₹{{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
        {{-- @endif --}}
    </div>
    </div>

    @if (!$cartItems->isEmpty())
        <!-- Address Section -->
        <div class="address-section mt-4">
            <h3 class="section-title"><i class="fas fa-map-marker-alt me-2"></i>Shipping Address</h3>

            <form method="POST" action="{{ route('user-checkout') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                            name="first_name" value="{{ old('first_name', auth()->user()->first_name ?? '') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                            name="last_name" value="{{ old('last_name', auth()->user()->last_name ?? '') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address', auth()->user()->address ?? '') }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address2" class="form-label">Address 2 (Optional)</label>
                    <input type="text" class="form-control" id="address2" name="address_2" value="{{ old('address2') }}"
                        placeholder="Apartment, suite, etc.">
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select @error('country') is-invalid @enderror" id="country" name="country"
                            required>
                            <option value="">Choose...</option>
                            <option value="India"
                                {{ old('country', auth()->user()->country ?? '') == 'India' ? 'selected' : '' }}>India
                            </option>
                            <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>United States</option>
                        </select>
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select @error('state') is-invalid @enderror" id="state" name="state"
                            required>
                            <option value="">Choose...</option>
                            <option value="Delhi"
                                {{ old('state', auth()->user()->state ?? '') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                            <option value="Maharashtra" {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra
                            </option>
                            <option value="Maharashtra" {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Haryana
                            </option>
                            <option value="Maharashtra" {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Punjab
                            </option>
                        </select>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                            name="city" value="{{ old('city', auth()->user()->city ?? '') }}" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="zip" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control @error('zip') is-invalid @enderror" id="zip"
                            name="zip_code" value="{{ old('zip', auth()->user()->zip ?? '') }}" required>
                        @error('zip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="save_address" name="save_address"
                        value="1" checked>
                    <label class="form-check-label" for="save_address">
                        Save this address for future use
                    </label>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-checkout btn-lg">
                        <i class="fas fa-lock me-2"></i> Complete Order
                        {{-- (₹{{ number_format($total, 2) }}) --}}
                    </button>
                </div>
            </form>
        </div>
    @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method selection
            document.querySelectorAll('.payment-method').forEach(method => {
                method.addEventListener('click', function() {
                    document.querySelectorAll('.payment-method').forEach(m => m.classList.remove(
                        'active'));
                    this.classList.add('active');

                    // Hide all payment fields first
                    document.querySelectorAll('.payment-fields').forEach(field => {
                        field.style.display = 'none';
                    });

                    // Show selected payment fields
                    const methodType = this.getAttribute('data-method');
                    document.getElementById(methodType + 'Fields').style.display = 'block';
                });
            });

            // Initialize with credit card selected
            document.querySelector('.payment-method[data-method="credit"]').click();
        });
    </script>
@endsection
