<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
        /* Global Styles */
        :root {
            --primary-color: #4e73df;
            --primary-hover: #3a5ec0;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            --sidebar-bg: #ffffff;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
            --header-height: 70px;
            --shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fc;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Top Header Styles */
        .top-header {
            background-color: white;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: var(--header-height);
        }

        .mobile-logo {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .mobile-logo i {
            margin-right: 0.5rem;
        }

        .mobile-menu-toggle {
            background: none;
            border: none;
            color: var(--dark-color);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .mobile-user-menu {
            position: relative;
        }

        .mobile-user-btn {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .mobile-user-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.5rem;
        }

        .mobile-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
            padding: 0.5rem 0;
            min-width: 180px;
            display: none;
            z-index: 1001;
        }

        .mobile-dropdown.active {
            display: block;
        }

        .mobile-dropdown a {
            display: block;
            padding: 0.5rem 1rem;
            color: var(--dark-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .mobile-dropdown a:hover {
            background-color: rgba(0,0,0,0.05);
            color: var(--primary-color);
        }

        /* Sidebar Navigation */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: var(--transition);
            height: 100vh;
            position: fixed;
            top: var(--header-height);
            left: -100%;
            z-index: 999;
            display: flex;
            flex-direction: column;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 0;
        }

        .sidebar-menu ul {
            list-style: none;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--dark-color);
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover {
            color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.05);
        }

        .sidebar-menu li a.active {
            color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.1);
            border-left-color: var(--primary-color);
        }

        .sidebar-menu li a i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.75rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--secondary-color);
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0.5rem 0;
        }

        .logout-btn i {
            margin-right: 0.5rem;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-top: var(--header-height);
            padding: 1.5rem;
            transition: var(--transition);
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .header-actions {
            display: flex;
            gap: 0.75rem;
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .notification-btn {
            background-color: transparent;
            color: var(--dark-color);
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .notification-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .user-btn {
            background-color: transparent;
            color: var(--dark-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .user-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 600;
        }

        .btn-icon {
            background-color: transparent;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            transition: var(--transition);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-icon:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--primary-color);
        }

        /* Welcome Page Styles */
        .welcome-hero {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-radius: 0.5rem;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .hero-content {
            flex: 1;
            padding-right: 2rem;
        }

        .hero-content h2 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .hero-content p {
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .hero-image img {
            max-width: 250px;
            height: auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            margin-right: 1rem;
        }

        .stat-info h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .stat-info p {
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        .recent-activity {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .recent-activity h3 {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .activity-icon.primary {
            background-color: var(--primary-color);
        }

        .activity-icon.success {
            background-color: var(--success-color);
        }

        .activity-icon.warning {
            background-color: var(--warning-color);
        }

        .activity-details p {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--secondary-color);
        }


        /* Enhanced Category Page Styles */
        .category-container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .category-form-container {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .category-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .category-form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .category-form-toggle {
            background: none;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .category-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-column {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-image-preview {
            width: 100%;
            height: 200px;
            border-radius: 0.5rem;
            object-fit: cover;
            border: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        .category-list-container {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .category-list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .category-list-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .category-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .category-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background-color: var(--primary-color);
        }

        .category-card h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            font-weight: 600;
        }

        .category-card p {
            color: var(--secondary-color);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .category-actions {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
        }

        .action-btn {
            background-color: rgba(0, 0, 0, 0.05);
            border: none;
            border-radius: 0.25rem;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .action-btn.edit {
            color: var(--info-color);
        }

        .action-btn.delete {
            color: var(--danger-color);
        }

        .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .category-stats {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.75rem;
            color: var(--secondary-color);
            margin-top: 0.5rem;
        }

        .category-stat {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            overflow-y: auto;
        }

        .modal-content {
            background-color: white;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 90%;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--secondary-color);
            cursor: pointer;
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger-color);
            transform: rotate(90deg);
        }

        .modal-body {
            margin-bottom: 2rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Adjust category page layout */
        .category-list-container {
            margin-top: 2rem;
        }



        /* Subcategory Page Styles */
        .subcategory-table-container {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            overflow-x: auto;
        }

        .subcategory-table {
            width: 100%;
            border-collapse: collapse;
        }

        .subcategory-table th,
        .subcategory-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .subcategory-table th {
            font-weight: 600;
            color: var(--dark-color);
            background-color: rgba(0, 0, 0, 0.02);
        }

        .subcategory-table tr:hover td {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.active {
            background-color: rgba(28, 200, 138, 0.1);
            color: var(--success-color);
        }

        .status-badge.inactive {
            background-color: rgba(231, 74, 59, 0.1);
            color: var(--danger-color);
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Form Styles */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .card-description {
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #5a5c69;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            color: #5a5c69;
            background-color: #fff;
            border-color: #bac8f3;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }

        .input-group-prepend {
            margin-right: -1px;
            display: flex;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin-bottom: 0;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6e707e;
            text-align: center;
            white-space: nowrap;
            background-color: #eaecf4;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .text-danger {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.35rem;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .grid-margin {
            margin-bottom: 1.5rem;
        }

        .stretch-card {
            display: flex;
            align-items: stretch;
            justify-content: stretch;
        }

        .stretch-card > .card {
            width: 100%;
            min-width: 100%;
        }

        .form-inline {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mr-sm-2 {
            margin-right: 0.5rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        /* Responsive Styles */
        @media (min-width: 992px) {
            .top-header {
                display: none;
            }
            
            .sidebar {
                width: var(--sidebar-width);
                top: 0;
                left: 0;
            }
            
            .main-content {
                margin-left: var(--sidebar-width);
                margin-top: 0;
            }
        }

        @media (max-width: 992px) {
            .welcome-hero {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-content {
                padding-right: 0;
                margin-bottom: 1.5rem;
            }
            
            .hero-image img {
                max-width: 200px;
            }

            .user-profile{
                display: none;
            }

            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .hero-content h2 {
                font-size: 1.5rem;
            }
            
            .hero-image img {
                max-width: 150px;
            }
        }

        @media (max-width: 576px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .category-grid {
                grid-template-columns: 1fr;
            }

            .category-form-header, 
            .category-list-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .form-inline {
                flex-direction: column;
                align-items: flex-start;
            }

            .input-group.mb-2.mr-sm-2 {
                margin-right: 0;
                width: 100%;
            }

            .modal-content {
                width: 95%;
                padding: 1.5rem;
            }
        }
        /* Animation for form toggle */
        .category-form-content {
            max-height: 1000px;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .category-form-content.collapsed {
            max-height: 0;
        }
    </style>
</head>
<body>
    <!-- Top Header for Mobile -->
    <header class="top-header">
        <button class="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="mobile-logo">
            <i class="fas fa-chart-pie"></i>
            <span>DashUI</span>
        </div>
        <div class="mobile-user-menu">
            <button class="mobile-user-btn">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="mobile-user-img">
                <i class="fas fa-caret-down"></i>
            </button>
            <div class="mobile-dropdown">
                <a href="#" class="logout-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <nav class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="#" class="welcome-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="category-link">
                        <i class="fas fa-layer-group"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="subcategory-link">
                        <i class="fas fa-tags"></i>
                        <span>Subcategories</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                <div class="user-info">
                    <span class="user-name">Sarah Johnson</span>
                    <span class="user-role">Admin</span>
                </div>
            </div>
            <a href="{{ route('userLogout') }}" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>


    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Page -->
        <section id="welcome-page" class="page">
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
                        <h2>Manage Your Data Efficiently</h2>
                        <p>Our dashboard provides powerful tools to organize and analyze your business data with beautiful visualizations.</p>
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
        
<!-- Category Page -->
<section id="category-page" class="page">
    <div class="page-header">
        <h1>Categories</h1>
        <div class="header-actions">
            <button class="btn btn-primary" id="openCategoryModal">
                <i class="fas fa-plus"></i> Add Category
            </button>
        </div>
    </div>
    
    <div class="page-content">
        <!-- Category List Section -->
        <div class="category-list-container">
            <div class="category-list-header">
                <h2 class="category-list-title">Your Categories</h2>
                <div class="category-search">
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Search categories...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-grid">
                <!-- Sample Category Cards -->
                <div class="category-card">
                    <div class="category-icon" style="background-color: #4e73df;">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3>Electronics</h3>
                    <p>Computers, phones, and gadgets</p>
                    <div class="category-stats">
                        <span class="category-stat">
                            <i class="fas fa-box"></i> 45 products
                        </span>
                        <span class="category-stat">
                            <i class="fas fa-eye"></i> 1.2K views
                        </span>
                    </div>
                    <div class="category-actions">
                        <button class="action-btn edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- More category cards... -->
            </div>
        </div>
    </div>
</section>

<!-- Category Modal -->
<div class="modal" id="categoryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add New Category</h3>
            <button class="modal-close" id="closeCategoryModal">&times;</button>
        </div>
        <div class="modal-body">
            <form action="add-category" method="post" enctype="multipart/form-data" id="categoryForm">
                @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif

                @csrf

                <div class="category-form">
                    <div class="form-column">
                        <div class="form-group">
                            <label for="tag" class="form-label">Category ID</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" class="form-control" id="tag" placeholder="CAT001" name="tag" value="{{old('tag')}}">
                            </div>
                            <span class="text-danger">@error('tag'){{$message}} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Category Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control" id="name" placeholder="Electronics" name="name" value="{{old('name')}}">
                            </div>
                            <span class="text-danger">@error('name'){{$message}} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="shortdesc" class="form-label">Short Description</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                </div>
                                <input type="text" class="form-control" id="shortdesc" placeholder="Brief description" name="shortdesc" value="{{old('shortdesc')}}">
                            </div>
                            <span class="text-danger">@error('shortdesc'){{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-group">
                            <label for="fulldesc" class="form-label">Full Description</label>
                            <textarea class="form-control" id="fulldesc" placeholder="Detailed description" rows="5" name="fulldesc">{{old('fulldesc')}}</textarea>
                            <span class="text-danger">@error('fulldesc'){{$message}} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="imglink" class="form-label">Image URL</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                </div>
                                <input type="text" class="form-control" id="imglink" placeholder="https://example.com/image.jpg" name="imglink" value="{{old('imglink')}}">
                            </div>
                            <span class="text-danger">@error('imglink'){{$message}} @enderror</span>
                            <img src="https://via.placeholder.com/300x200?text=Preview" alt="Image Preview" class="form-image-preview" id="imagePreview">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancelCategoryForm">
                <i class="fas fa-times"></i> Cancel
            </button>
            <button type="submit" form="categoryForm" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Category
            </button>
        </div>
    </div>
</div>
    </section>
        
        <!-- Subcategory Page -->
        <section id="subcategory-page" class="page">
            <div class="page-header">
                <h1>Subcategories</h1>
                <div class="header-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Subcategory
                    </button>
                </div>
            </div>
            
            <div class="page-content">
                <div class="subcategory-table-container">
                    <table class="subcategory-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parent Category</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Laptops</td>
                                <td>Electronics</td>
                                <td>24</td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <button class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Smartphones</td>
                                <td>Electronics</td>
                                <td>32</td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <button class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Men's Clothing</td>
                                <td>Clothing</td>
                                <td>58</td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <button class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Furniture</td>
                                <td>Home & Garden</td>
                                <td>42</td>
                                <td><span class="status-badge inactive">Inactive</span></td>
                                <td>
                                    <button class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Fiction</td>
                                <td>Books</td>
                                <td>67</td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <button class="btn-icon">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-icon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
            // Navigation elements
            const sidebar = document.querySelector('.sidebar');
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const sidebarOverlay = document.querySelector('.sidebar-overlay');
            const welcomeLink = document.querySelector('.welcome-link');
            const categoryLink = document.querySelector('.category-link');
            const subcategoryLink = document.querySelector('.subcategory-link');
            const mobileUserBtn = document.querySelector('.mobile-user-btn');
            const mobileDropdown = document.querySelector('.mobile-dropdown');
            //const logoutLinks = document.querySelectorAll('.logout-btn, .logout-link');
            
            // Page elements
            const welcomePage = document.getElementById('welcome-page');
            const categoryPage = document.getElementById('category-page');
            const subcategoryPage = document.getElementById('subcategory-page');
            
            // Set welcome page as active by default
            setActivePage('welcome');
            setActiveNavLink(welcomeLink);
            
            // Toggle mobile sidebar
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = 'hidden';
            });
            
            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            // Mobile user menu toggle
            mobileUserBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileDropdown.classList.toggle('active');
            });
            
            // Close dropdown when clicking elsewhere
            document.addEventListener('click', function() {
                if (mobileDropdown.classList.contains('active')) {
                    mobileDropdown.classList.remove('active');
                }
            });
            
            // Navigation between pages
            welcomeLink.addEventListener('click', function(e) {
                e.preventDefault();
                setActivePage('welcome');
                setActiveNavLink(this);
                closeSidebarOnMobile();
            });
            
            categoryLink.addEventListener('click', function(e) {
                e.preventDefault();
                setActivePage('category');
                setActiveNavLink(this);
                closeSidebarOnMobile();
            });
            
            subcategoryLink.addEventListener('click', function(e) {
                e.preventDefault();
                setActivePage('subcategory');
                setActiveNavLink(this);
                closeSidebarOnMobile();
            });
            
            // Logout functionality
            logoutLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('Logout functionality would be implemented here');
                    // In a real app, you would redirect to logout URL or clear session
                });
            });
            
            // Set active page
            function setActivePage(page) {
                welcomePage.classList.remove('active');
                categoryPage.classList.remove('active');
                subcategoryPage.classList.remove('active');
                
                if (page === 'welcome') welcomePage.classList.add('active');
                if (page === 'category') categoryPage.classList.add('active');
                if (page === 'subcategory') subcategoryPage.classList.add('active');
            }
            
            // Set active navigation link
            function setActiveNavLink(link) {
                document.querySelectorAll('.sidebar-menu a').forEach(item => {
                    item.classList.remove('active');
                });
                link.classList.add('active');
            }
            
            // Close sidebar on mobile after navigation
            function closeSidebarOnMobile() {
                if (window.innerWidth < 992) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
            
            // Add hover effects to cards
            const cards = document.querySelectorAll('.stat-card, .category-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 0.5rem 1.5rem rgba(0, 0, 0, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });
            
            // Add click effect to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'translateY(1px)';
                });
                
                button.addEventListener('mouseup', function() {
                    this.style.transform = '';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.add('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                } else {
                    sidebar.classList.remove('active');
                }
            });

            // Category Form Toggle (from previous enhancement)
            const formToggleBtn = document.getElementById('formToggleBtn');
            const toggleFormBtn = document.getElementById('toggleFormBtn');
            const categoryForm = document.getElementById('categoryForm');
            const imagePreview = document.getElementById('imagePreview');
            const imgLinkInput = document.getElementById('imglink');

            if (formToggleBtn && categoryForm) {
                let isFormCollapsed = false;

                formToggleBtn.addEventListener('click', function() {
                    isFormCollapsed = !isFormCollapsed;
                    categoryForm.classList.toggle('collapsed', isFormCollapsed);
                    formToggleBtn.innerHTML = isFormCollapsed 
                        ? '<i class="fas fa-chevron-down"></i><span>Expand Form</span>'
                        : '<i class="fas fa-chevron-up"></i><span>Collapse Form</span>';
                });

                toggleFormBtn.addEventListener('click', function() {
                    if (isFormCollapsed) {
                        isFormCollapsed = false;
                        categoryForm.classList.remove('collapsed');
                        formToggleBtn.innerHTML = '<i class="fas fa-chevron-up"></i><span>Collapse Form</span>';
                        categoryForm.scrollIntoView({ behavior: 'smooth' });
                    }
                });

                // Image Preview
                if (imgLinkInput && imagePreview) {
                    imgLinkInput.addEventListener('input', function() {
                        if (this.value) {
                            imagePreview.src = this.value;
                        } else {
                            imagePreview.src = 'https://via.placeholder.com/300x200?text=Preview';
                        }
                    });
                }
            }
        });
        // Modal Elements
        const categoryModal = document.getElementById('categoryModal');
            const openModalBtn = document.getElementById('openCategoryModal');
            const closeModalBtn = document.getElementById('closeCategoryModal');
            const cancelFormBtn = document.getElementById('cancelCategoryForm');
            const imagePreview = document.getElementById('imagePreview');
            const imgLinkInput = document.getElementById('imglink');

            // Open modal when clicking Add Category button
            openModalBtn.addEventListener('click', function() {
                categoryModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });

            // Close modal when clicking close button
            closeModalBtn.addEventListener('click', function() {
                categoryModal.style.display = 'none';
                document.body.style.overflow = '';
            });

            // Close modal when clicking cancel button
            cancelFormBtn.addEventListener('click', function() {
                categoryModal.style.display = 'none';
                document.body.style.overflow = '';
            });

            // Close modal when clicking outside the modal content
            window.addEventListener('click', function(event) {
                if (event.target === categoryModal) {
                    categoryModal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });

            // Image Preview
            if (imgLinkInput && imagePreview) {
                imgLinkInput.addEventListener('input', function() {
                    if (this.value) {
                        imagePreview.src = this.value;
                    } else {
                        imagePreview.src = 'https://via.placeholder.com/300x200?text=Preview';
                    }
                });
            }

            // Close modal on successful form submission
            const categoryForm = document.getElementById('categoryForm');
            if (categoryForm) {
                categoryForm.addEventListener('submit', function() {
                    // In a real app, you would wait for successful submission
                    // For demo purposes, we'll just close the modal
                    setTimeout(() => {
                        categoryModal.style.display = 'none';
                        document.body.style.overflow = '';
                    }, 1000);
                });
            }
    </script>
</body>
</html>