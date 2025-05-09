<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Your Brand</title>
    <link rel="stylesheet" href="auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Base Styles */
:root {
    --primary-color: #4361ee;
    --secondary-color: #3f37c9;
    --accent-color: #4895ef;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --success-color: #4cc9f0;
    --error-color: #f72585;
    --border-radius: 8px;
    --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: var(--dark-color);
    line-height: 1.6;
}

a {
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition);
}

a:hover {
    color: var(--secondary-color);
}

/* Auth Container */
.auth-container {
    display: flex;
    min-height: 100vh;
}

.auth-card {
    flex: 1;
    max-width: 500px;
    padding: 2rem;
    background-color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.auth-decoration {
    flex: 1;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.decoration-content {
    max-width: 500px;
    text-align: center;
}

.decoration-content h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.decoration-content p {
    margin-bottom: 1.5rem;
    opacity: 0.9;
}

.decoration-btn {
    display: inline-block;
    padding: 0.8rem 2rem;
    background-color: transparent;
    border: 2px solid white;
    color: white;
    border-radius: var(--border-radius);
    font-weight: 600;
    transition: var(--transition);
}

.decoration-btn:hover {
    background-color: white;
    color: var(--primary-color);
}

/* Auth Header */
.auth-header {
    margin-bottom: 2rem;
    text-align: center;
}

.auth-header h1 {
    font-size: 2rem;
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.auth-header p {
    color: #6c757d;
}

/* Auth Form */
.auth-form {
    width: 100%;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--dark-color);
}

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.input-with-icon input {
    width: 100%;
    padding: 12px 15px 12px 45px;
    border: 1px solid #ced4da;
    border-radius: var(--border-radius);
    font-size: 1rem;
    transition: var(--transition);
}

.input-with-icon input:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
}

.password-hint, .forgot-password {
    font-size: 0.85rem;
    margin-top: 0.5rem;
    color: #6c757d;
}

.forgot-password {
    text-align: right;
}

.terms {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.terms input {
    margin-right: 10px;
}

.terms label {
    margin-bottom: 0;
    font-weight: normal;
}

/* Auth Button */
.auth-btn {
    width: 100%;
    padding: 12px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    margin-bottom: 1.5rem;
}

.auth-btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
}

/* Auth Footer */
.auth-footer {
    text-align: center;
}

.auth-footer p {
    margin-bottom: 1.5rem;
    color: #6c757d;
}

.social-login p {
    position: relative;
    margin: 1.5rem 0;
    color: #6c757d;
}

.social-login p::before,
.social-login p::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 30%;
    height: 1px;
    background-color: #dee2e6;
}

.social-login p::before {
    left: 0;
}

.social-login p::after {
    right: 0;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #f1f3f5;
    color: var(--dark-color);
    transition: var(--transition);
}

.social-icon:hover {
    background-color: var(--primary-color);
    color: white;
}

/*Error style*/
.error {
    color: #bd0000;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .auth-container {
        flex-direction: column;
    }
    
    .auth-card {
        max-width: 100%;
        padding: 2rem 1.5rem;
    }
    
    .auth-decoration {
        padding: 2rem 1.5rem;
    }
    
    .decoration-content {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .auth-header h1 {
        font-size: 1.75rem;
    }
    
    .input-with-icon input {
        padding: 10px 15px 10px 40px;
    }
    
    .social-icons {
        gap: 0.75rem;
    }
    
    .social-icon {
        width: 36px;
        height: 36px;
        font-size: 0.9rem;
    }
}
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Create Account</h1>
                <p>Join us today for exclusive features</p>
            </div>


            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('fail'))
                <div class="alert alert-success">
                    {{ session('fail') }}
                </div>
            @endif

            
            
            <form class="auth-form" action="{{ route('userRegister') }}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="fullname" placeholder="Enter your full name" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" placeholder="Enter your email" name="email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" placeholder="Create a password" name="password" required>
                    </div>
                    <div class="password-hint">
                        <p>Use 8 or more characters with a mix of letters, numbers & symbols</p>
                    </div>
                </div>
                
                <!--<div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirm-password" placeholder="Confirm your password" name="confirmPwd" required>
                    </div>
                </div>
                
                <div class="form-group terms">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                </div>-->
                <button type="submit" class="auth-btn">Register Now</button>
                
                <div class="auth-footer">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                    
                    <div class="social-login">
                        <p>Or sign up with</p>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="auth-decoration">
            <div class="decoration-content">
                <h2>Welcome!</h2>
                <p>We're excited to have you join our platform.</p>
                <p>Get started with your account to access all features.</p>
                <a href="{{ route('login') }}" class="decoration-btn">Sign In</a>
            </div>
        </div>
    </div>
</body>
</html>