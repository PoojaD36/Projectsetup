@extends('comman.layout')
@section('title', 'Dashboard')
@section('content')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Page -->
        <section id="welcome-page">
            <div class="page-header">
                <h1>Welcome to DashUI</h1>
                <div class="header-actions">
                    <button class="btn notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </button>
                    <button class="btn user-btn">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </div>
            
            <div class="page-content">
                <div class="welcome-hero">
                    <div class="hero-content">
                        <h2>Hiii, Welcome</h2>
                        <p>Your one-stop online store offering a wide range of products—from electronics and fashion to home essentials—all at great prices with fast delivery.</p>
                        <button class="btn btn-primary">Get Started</button>
                    </div>
                    <div class="hero-image">
                        <img src="https://cdn-icons-png.flaticon.com/512/3132/3132693.png" alt="Dashboard Illustration">
                    </div>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #4e73df;">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="stat-info">
                            <h3>245</h3>
                            <p>New Orders</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #1cc88a;">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$12,345</h3>
                            <p>Total Revenue</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #36b9cc;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1,234</h3>
                            <p>Active Users</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #f6c23e;">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3>87%</h3>
                            <p>Completion Rate</p>
                        </div>
                    </div>
                </div>
                
                <div class="recent-activity">
                    <h3>Recent Activity</h3>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="activity-details">
                                <p>New order received #12345</p>
                                <span class="activity-time">10 minutes ago</span>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon warning">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            <div class="activity-details">
                                <p>Low inventory alert for Product X</p>
                                <span class="activity-time">25 minutes ago</span>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon primary">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-details">
                                <p>New user registered: john.doe</p>
                                <span class="activity-time">1 hour ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection