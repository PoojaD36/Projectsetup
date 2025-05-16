@extends('User-dashboard.layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4><i class="fas fa-check-circle"></i> Order Placed Successfully!</h4>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-success">
                        <h5>Thank you for your order!</h5>
                        <p>Your order number is: <strong>{{ $order->order_number }}</strong></p>
                        <p>We've sent a confirmation email to your registered email address.</p>
                    </div>
                    <a href="{{ route('user-checkout') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Show popup when page loads
    document.addEventListener('DOMContentLoaded', function() {
        alert('Order placed successfully! Your order number is: {{ $order->order_number }}');
    });
</script>
@endsection