    
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-logo mb-3"><a href="{{ route('user-product-view') }}">ShopEase</a></div>
                    <p>Your one-stop shop for all your needs. We offer high-quality products at competitive prices with
                        excellent customer service.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Products</a></li>
                        <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                {{-- <div class="col-md-3">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        @foreach ($categories as $category)
                            <li><a href="#" class="text-white text-decoration-none">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}
                <div class="col-md-3">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Main Street, City, Country</li>
                        <li><i class="fas fa-phone me-2"></i> +1 234 567 890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@shopease.com</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4 pt-3 border-top">
                &copy; {{ date('Y') }} ShopEase. All Rights Reserved.
            </div>
        </div>
    </footer>
