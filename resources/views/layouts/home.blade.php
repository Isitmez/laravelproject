<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AzuraShop') — Online Alışveriş</title>
    <meta name="description" content="@yield('meta_description', 'AzuraShop - En iyi fiyatlarla online alışveriş')">
    <meta name="keywords" content="@yield('meta_keywords', 'online alışveriş, e-ticaret, ürünler')">

    {{-- Dark Mode Immediate Execution Script --}}
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark-mode');
            } else {
                document.documentElement.classList.remove('dark-mode');
            }
        })();
    </script>

    {{-- Favicon --}}
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Owl Carousel --}}
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    {{-- Custom Style --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        .cart-badge { background: #ff4757; color: #fff; border-radius: 50%; width: 18px; height: 18px;
                      font-size: .65rem; display: inline-flex; align-items: center; justify-content: center;
                      position: absolute; top: -6px; right: -8px; font-weight: 700; }
        
        /* Premium Product Card Styles */
        .product-card { 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important; 
            border: 1px solid rgba(0,0,0,0.03) !important;
            background: #fff;
        }
        .product-card:hover { 
            transform: translateY(-8px) !important; 
            box-shadow: 0 16px 32px rgba(0,0,0,0.08) !important; 
        }
        .product-card img {
            transition: transform 0.5s ease !important;
        }
        .product-card:hover img {
            transform: scale(1.06) !important;
        }
        .product-image-container {
            position: relative;
        }
        .product-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 14, 19, 0.4);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(2px);
            z-index: 2;
        }
        .product-card:hover .product-overlay {
            opacity: 1;
        }
        .product-overlay .btn {
            transform: translateY(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .product-card:hover .product-overlay .btn {
            transform: translateY(0);
        }
        
        .btn-primary { background: #ff4757; border-color: #ff4757; }
        .btn-primary:hover { background: #ff2d3f; border-color: #ff2d3f; }
        .text-primary { color: #ff4757 !important; }
        .border-primary { border-color: #ff4757 !important; }
        .alert { border-radius: 8px; }
        .discount-badge { background: #ff4757; color: white; font-size: .7rem; padding: 2px 8px;
                          border-radius: 4px; font-weight: 600; }

        /* Carousel Controls & Layout Overrides */
        #header-carousel {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            background: transparent !important;
        }
        .carousel-inner {
            width: 100% !important;
            max-width: 100% !important;
        }
        .carousel-item {
            width: 100% !important;
            max-width: 100% !important;
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: 48px !important;
            height: 48px !important;
            background: rgba(255, 255, 255, 0.15) !important;
            border-radius: 50% !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            margin: 0 20px !important;
            backdrop-filter: blur(6px) !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
            opacity: 0.8 !important;
            transition: all 0.3s ease !important;
        }
        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1 !important;
            background: rgba(255, 255, 255, 0.3) !important;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2) !important;
            transform: translateY(-50%) scale(1.05) !important;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 18px !important;
            height: 18px !important;
        }

        /* Bootstrap 5 to Bootstrap 4 utility mapping helpers */
        .me-1 { margin-right: 0.25rem !important; }
        .me-2 { margin-right: 0.5rem !important; }
        .me-3 { margin-right: 1rem !important; }
        .me-4 { margin-right: 1.5rem !important; }
        .me-5 { margin-right: 3rem !important; }
        .me-auto { margin-right: auto !important; }

        .ms-1 { margin-left: 0.25rem !important; }
        .ms-2 { margin-left: 0.5rem !important; }
        .ms-3 { margin-left: 1rem !important; }
        .ms-4 { margin-left: 1.5rem !important; }
        .ms-5 { margin-left: 3rem !important; }
        .ms-auto { margin-left: auto !important; }

        .pe-1 { padding-right: 0.25rem !important; }
        .pe-2 { padding-right: 0.5rem !important; }
        .pe-3 { padding-right: 1rem !important; }
        .pe-4 { padding-right: 1.5rem !important; }
        .pe-5 { padding-right: 3rem !important; }

        .ps-1 { padding-left: 0.25rem !important; }
        .ps-2 { padding-left: 0.5rem !important; }
        .ps-3 { padding-left: 1rem !important; }
        .ps-4 { padding-left: 1.5rem !important; }
        .ps-5 { padding-left: 3rem !important; }

        .gap-1 { gap: 0.25rem !important; }
        .gap-2 { gap: 0.5rem !important; }
        .gap-3 { gap: 1rem !important; }
        .gap-4 { gap: 1.5rem !important; }
        .gap-5 { gap: 3rem !important; }

        /* High Contrast Nav Links Fix */
        .navbar-light .navbar-nav .nav-link.active,
        .navbar-light .navbar-nav .nav-link:hover {
            color: #e94560 !important;
            font-weight: 600 !important;
        }

        /* 🌙 PREMIUM DARK MODE STYLES */
        html.dark-mode body {
            background-color: #0f0e13 !important;
            color: #e2e8f0 !important;
        }

        /* Background Colors */
        html.dark-mode .bg-white,
        html.dark-mode .navbar.bg-white,
        html.dark-mode .card,
        html.dark-mode .dropdown-menu {
            background-color: #16151c !important;
        }

        html.dark-mode .bg-light,
        html.dark-mode .list-group-item,
        html.dark-mode .table,
        html.dark-mode .table td,
        html.dark-mode .table th,
        html.dark-mode .breadcrumb-item::before {
            background-color: #1d1b26 !important;
        }

        /* Text Color Overrides */
        html.dark-mode h1,
        html.dark-mode h2,
        html.dark-mode h3,
        html.dark-mode h4,
        html.dark-mode h5,
        html.dark-mode h6,
        html.dark-mode .fw-bold,
        html.dark-mode .fw-semibold,
        html.dark-mode .card-title,
        html.dark-mode .dropdown-item,
        html.dark-mode .navbar-light .navbar-brand,
        html.dark-mode .navbar-light .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        html.dark-mode .text-muted,
        html.dark-mode .breadcrumb-item a {
            color: #a0aec0 !important;
        }

        html.dark-mode .text-dark {
            color: #cbd5e0 !important;
        }

        /* Inline Dark Blue Text Color Helper */
        html.dark-mode [style*="color:#1a1a2e"],
        html.dark-mode [style*="color: #1a1a2e"] {
            color: #ffffff !important;
        }

        /* Inline Light Gray Background Helper (cards, product details) */
        html.dark-mode div[style*="background:#f8f9fa"],
        html.dark-mode div[style*="background: #f8f9fa"] {
            background-color: #1d1b26 !important;
        }

        html.dark-mode div[style*="background:#f8f9fa;height:420px;font-size:8rem;"],
        html.dark-mode div[style*="height:420px;font-size:8rem;"] {
            background-color: #1d1b26 !important;
        }

        /* Pink Gradient Banner Override (Discount section) */
        html.dark-mode div[style*="background:linear-gradient(135deg,#fff5f5,#fff)"],
        html.dark-mode div[style*="background: linear-gradient(135deg, #fff5f5, #fff)"] {
            background: linear-gradient(135deg, #231215, #16151c) !important;
        }

        /* Form Controls */
        html.dark-mode .form-control,
        html.dark-mode .form-select,
        html.dark-mode .input-group-text,
        html.dark-mode .input-group .btn {
            background-color: #1d1b26 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
        }

        html.dark-mode .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
        }

        html.dark-mode .form-control:focus,
        html.dark-mode .form-select:focus {
            background-color: #1d1b26 !important;
            border-color: #e94560 !important;
            box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.25) !important;
            color: #ffffff !important;
        }

        /* Buttons & Badges */
        html.dark-mode .btn-outline-dark,
        html.dark-mode .btn-outline-secondary {
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.25) !important;
        }

        html.dark-mode .btn-outline-dark:hover,
        html.dark-mode .btn-outline-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        html.dark-mode .badge.bg-light {
            background-color: #1d1b26 !important;
            color: #ff4757 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Borders */
        html.dark-mode .border,
        html.dark-mode .border-bottom,
        html.dark-mode .border-top,
        html.dark-mode .border-start-0,
        html.dark-mode .border-end-0,
        html.dark-mode .card-header,
        html.dark-mode .card-footer,
        html.dark-mode hr {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Navbar & Dropdown Specifics */
        html.dark-mode .navbar-light .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.75) !important;
        }
        html.dark-mode .navbar-toggler-icon {
            filter: invert(1);
        }
        html.dark-mode .dropdown-menu {
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
        }
        html.dark-mode .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }

        /* Product Cards Specifics */
        html.dark-mode .product-card {
            background: #16151c !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }
        html.dark-mode .product-card:hover {
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.4) !important;
        }

        /* Carousel Controls */
        html.dark-mode .carousel-control-prev,
        html.dark-mode .carousel-control-next {
            background: rgba(0, 0, 0, 0.4) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        html.dark-mode .carousel-control-prev:hover,
        html.dark-mode .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.6) !important;
        }

        /* Breadcrumb Specifics */
        html.dark-mode .breadcrumb {
            background-color: transparent !important;
        }
        html.dark-mode .breadcrumb-item.active {
            color: #ffffff !important;
        }

        /* Pagination Specifics */
        html.dark-mode .page-link {
            background-color: #16151c !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #ff4757 !important;
        }
        html.dark-mode .page-item.active .page-link {
            background-color: #ff4757 !important;
            border-color: #ff4757 !important;
            color: #ffffff !important;
        }
        html.dark-mode .page-item.disabled .page-link {
            background-color: #0f0e13 !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
            color: rgba(255, 255, 255, 0.3) !important;
        }

        /* Alert Styling Overrides */
        html.dark-mode .alert {
            background-color: #16151c !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }
        html.dark-mode .alert-success {
            border-left: 4px solid #28a745 !important;
        }
        html.dark-mode .alert-danger {
            border-left: 4px solid #dc3545 !important;
        }

        /* Light theme btn-outline-secondary contrast fix */
        html:not(.dark-mode) .btn-outline-secondary {
            color: #4a5568 !important;
            border-color: #cbd5e0 !important;
        }
        html:not(.dark-mode) .btn-outline-secondary:hover {
            color: #ffffff !important;
            background-color: #e94560 !important;
            border-color: #e94560 !important;
        }

        /* 💎 PREMIUM HEADER BANNER WITH PATTERN */
        .premium-banner {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%) !important;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 16px 16px;
        }
        .premium-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            opacity: 0.12;
            background-image: radial-gradient(circle at 1px 1px, #ffffff 1px, transparent 0);
            background-size: 16px 16px;
            pointer-events: none;
        }
        .premium-banner::after {
            content: '';
            position: absolute;
            top: -50%; right: -10%;
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(233, 69, 96, 0.25) 0%, transparent 70%);
            pointer-events: none;
            filter: blur(40px);
        }

        /* 🛒 CART DRAWER CUSTOM CSS */
        #cartDrawer.show {
            transform: translateX(0) !important;
            visibility: visible !important;
        }
        #cartDrawer {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .btn-close i {
            color: inherit;
        }
        html.dark-mode #cartDrawer {
            background-color: #16151c !important;
            border-left: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #ffffff !important;
        }
        html.dark-mode #cartDrawer > div:first-child {
            border-bottom-color: rgba(255, 255, 255, 0.08) !important;
        }
        html.dark-mode #cartDrawerFooter {
            background-color: #1d1b26 !important;
            border-top-color: rgba(255, 255, 255, 0.08) !important;
        }
        html.dark-mode .btn-close {
            filter: invert(1);
        }

        /* 🔍 SEARCH AUTOCOMPLETE CUSTOM CSS */
        .search-autocomplete-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            z-index: 1000;
            margin-top: 8px;
            max-height: 380px;
            overflow-y: auto;
            border: 1px solid rgba(0,0,0,0.08);
            display: none;
        }
        .search-autocomplete-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none !important;
            color: inherit !important;
            transition: background 0.2s;
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }
        .search-autocomplete-item:last-child {
            border-bottom: none;
        }
        .search-autocomplete-item:hover {
            background: rgba(0,0,0,0.02);
        }
        .search-autocomplete-image {
            width: 45px;
            height: 45px;
            object-fit: contain;
            border-radius: 6px;
            margin-right: 12px;
            background: #f8f9fa;
        }
        .search-autocomplete-title {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .search-autocomplete-price {
            font-size: 0.85rem;
            color: #ff4757;
            font-weight: 600;
        }
        html.dark-mode .search-autocomplete-results {
            background-color: #16151c !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4) !important;
        }
        html.dark-mode .search-autocomplete-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        html.dark-mode .search-autocomplete-image {
            background: #1d1b26;
        }
        
        /* 🔍 QUICK VIEW MODAL DARK MODE ADJUSTMENT */
        html.dark-mode #quickViewModal .modal-content {
            background-color: #16151c !important;
            color: #ffffff !important;
        }
        html.dark-mode #quickViewModal .col-md-6 {
            background: #1d1b26 !important;
        }

        /* Smooth Dark Mode Transition */
        body, nav, .card, .modal-content, .table, th, td, h1, h2, h3, h4, h5, h6, p, a, button, input, select, textarea, span:not(.cart-badge):not(.owl-prev):not(.owl-next) {
            transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease, fill 0.25s ease !important;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Flash Messages --}}
    @if(session('success') || session('error'))
    <div style="position:fixed;top:15px;right:15px;z-index:9999;max-width:350px;">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
    </div>
    @endif

    @include('front.header')

    @yield('content')

    @include('front.footer')

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Bootstrap JS (for alerts, dropdowns) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Owl Carousel --}}
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Auto-dismiss alerts --}}
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(el);
                bsAlert.close();
            });
        }, 4000);
    </script>

    {{-- Dark Mode Toggle Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('darkModeToggle');
            if (toggleBtn) {
                const icon = toggleBtn.querySelector('i');
                
                // Function to update toggle icon & button style
                const updateToggleUI = (isDark) => {
                    if (isDark) {
                        icon.className = 'bi bi-sun';
                        toggleBtn.className = 'btn btn-outline-light mr-3 d-flex align-items-center justify-content-center';
                    } else {
                        icon.className = 'bi bi-moon-stars';
                        toggleBtn.className = 'btn btn-outline-dark mr-3 d-flex align-items-center justify-content-center';
                    }
                };

                // Sync UI state on page load
                const isDarkModeActive = document.documentElement.classList.contains('dark-mode');
                updateToggleUI(isDarkModeActive);

                // Add click listener
                toggleBtn.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.toggle('dark-mode');
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                    updateToggleUI(isDark);
                });
            }
        });
    </script>

    <!-- Drawer overlay -->
    <div id="cartOverlay" onclick="toggleCartDrawer(false)" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:1049; backdrop-filter:blur(2px);"></div>

    <!-- 🛒 CART DRAWER -->
    <div id="cartDrawer" style="position:fixed; top:0; right:0; width:400px; max-width:100vw; height:100vh; z-index:1050; background:#fff; border-left:1px solid rgba(0,0,0,.07); transform:translateX(100%); transition:transform 0.32s cubic-bezier(0.4,0,0.2,1); box-shadow:-8px 0 32px rgba(0,0,0,0.12); display:flex; flex-direction:column;">
        <div style="padding:1rem 1.2rem; border-bottom:1px solid rgba(0,0,0,0.06); display:flex; align-items:center; justify-content:space-between; flex-shrink:0;">
            <h5 style="margin:0; font-weight:800; font-size:1rem; display:flex; align-items:center; gap:8px;">
                <span style="color:#e94560;"><i class="bi bi-bag"></i></span> {{ __('Cart') }}
                <span id="drawerCartCount" style="background:rgba(233,69,96,0.1); color:#e94560; font-size:0.72rem; border-radius:20px; padding:2px 10px; font-weight:700;">0</span>
            </h5>
            <button onclick="toggleCartDrawer(false)" style="background:none; border:none; cursor:pointer; padding:6px; border-radius:8px; color:#6b7280; font-size:1.1rem; display:flex; align-items:center; transition:all 0.2s;" onmouseover="this.style.background='rgba(0,0,0,0.05)'" onmouseout="this.style.background='none'">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div id="cartDrawerBody" style="flex:1; overflow-y:auto; padding:1rem 1.2rem;">
            <!-- Dynamic items loaded here -->
        </div>
        <div id="cartDrawerFooter" style="flex-shrink:0; padding:1rem 1.2rem; border-top:1px solid rgba(0,0,0,0.06); background:#fafafa;">
            <!-- Totals and checkout buttons -->
        </div>
    </div>

    <!-- 🔍 QUICK VIEW MODAL -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius:16px; border:none; overflow:hidden;">
                <div class="modal-body p-0 position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3 border-0 bg-transparent fs-4" data-bs-dismiss="modal" aria-label="Close" style="z-index:10; cursor:pointer;">
                        <i class="bi bi-x-lg"></i>
                    </button>
                    <div class="row g-0">
                        <div class="col-md-6" style="background:#f8f9fa;">
                            <div class="d-flex align-items-center justify-content-center h-100 p-4" style="min-height:350px;">
                                <img src="" id="qvProductImage" class="img-fluid" style="max-height:300px; object-fit:contain; border-radius:12px;">
                            </div>
                        </div>
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge mb-2" id="qvProductDiscount" style="background:#ff4757; color: white; display:none; padding:4px 8px; font-weight:600;"></span>
                                <h3 class="fw-bold mb-2" id="qvProductTitle" style="color:#1a1a2e;"></h3>
                                <div class="mb-3">
                                    <span class="fs-4 fw-bold text-primary" id="qvProductPrice"></span>
                                    <span class="text-decoration-line-through text-muted ms-2 small" id="qvProductOriginalPrice" style="display:none; font-size:0.9rem;"></span>
                                </div>
                                <p class="text-muted small" id="qvProductDescription" style="font-size:0.85rem; line-height:1.5;"></p>
                            </div>
                            <div>
                                <div class="mb-3 d-flex align-items-center gap-2">
                                    <span class="small fw-semibold text-muted">{{ __('Stock:') }}</span>
                                    <span class="badge bg-success-subtle text-success" id="qvProductStock" style="padding:4px 8px;"></span>
                                </div>
                                <div class="d-flex gap-2">
                                    <input type="number" id="qvQuantity" value="1" min="1" class="form-control text-center" style="width:70px; border-radius:8px;">
                                    <button class="btn text-white w-100 fw-semibold" id="qvAddToCartBtn" style="background:#e94560; border-radius:8px;">
                                        <i class="bi bi-cart-plus me-2"></i>{{ __('Add to Cart') }}
                                    </button>
                                </div>
                                <a href="" id="qvDetailLink" class="btn btn-link btn-sm text-muted w-100 text-center mt-2 text-decoration-none small" style="font-size:0.8rem;">{{ __('Product Details') }} <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ⚡ GENERAL AJAX SCRIPTS -->
    <script>
        // Toggle Cart Drawer
        function toggleCartDrawer(show) {
            const drawer = document.getElementById('cartDrawer');
            const overlay = document.getElementById('cartOverlay');
            if (show) {
                drawer.style.transform = 'translateX(0)';
                overlay.style.display = 'block';
                document.body.style.overflow = 'hidden';
                loadCartAjax();
            } else {
                drawer.style.transform = 'translateX(100%)';
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        // Show toast notification
        function showToast(type, message) {
            const container = document.getElementById('toast-container') || (() => {
                const el = document.createElement('div');
                el.id = 'toast-container';
                el.style.position = 'fixed';
                el.style.top = '15px';
                el.style.right = '15px';
                el.style.zIndex = '9999';
                el.style.maxWidth = '350px';
                document.body.appendChild(el);
                return el;
            })();

            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const iconClass = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
            
            const toast = document.createElement('div');
            toast.className = `alert ${alertClass} alert-dismissible fade show shadow mb-2`;
            toast.role = 'alert';
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bi ${iconClass} me-2 fs-5"></i>
                    <div class="me-2">${message}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="position:static; padding:0.5rem;"></button>
                </div>
            `;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(toast);
                bsAlert.close();
            }, 4000);
        }

        // Update Cart Drawer UI
        function updateCartDrawerUI(data) {
            const badges = document.querySelectorAll('.cart-badge');
            if (data.cart_count > 0) {
                badges.forEach(b => {
                    b.style.display = 'inline-flex';
                    b.innerText = data.cart_count;
                });
            } else {
                badges.forEach(b => b.style.display = 'none');
            }

            const drawerBody = document.getElementById('cartDrawerBody');
            const drawerFooter = document.getElementById('cartDrawerFooter');
            const countEl = document.getElementById('drawerCartCount');
            if (countEl) countEl.textContent = data.cart_count || 0;

            if (!data.cart || data.cart.length === 0) {
                drawerBody.innerHTML = `
                    <div style="text-align:center; padding:3rem 1rem;">
                        <div style="font-size:3.5rem; margin-bottom:12px;">🛒</div>
                        <p style="font-weight:700; color:#1a1a2e; margin-bottom:6px;">${"{{ __('Your Cart is Empty') }}"}</p>
                        <p style="font-size:0.85rem; color:#a0aec0; margin-bottom:1.5rem;">${"{{ __("You haven't added any products yet.") }}"}</p>
                        <a href="{{ route('shop.index') }}" onclick="toggleCartDrawer(false)" style="display:inline-block; background:#e94560; color:#fff; border-radius:8px; padding:10px 24px; font-weight:700; font-size:0.875rem; text-decoration:none;">${"{{ __('Start Shopping') }}"}</a>
                    </div>
                `;
                drawerFooter.innerHTML = '';
                return;
            }

            let itemsHtml = '';
            data.cart.forEach(item => {
                const imgSrc = item.image_url || '';
                const imgHtml = imgSrc
                    ? `<img src="${imgSrc}" alt="${item.title}" style="width:64px;height:64px;object-fit:cover;border-radius:10px;border:1px solid rgba(0,0,0,0.05);flex-shrink:0;">`
                    : `<div style="width:64px;height:64px;border-radius:10px;background:#f4f6f9;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0;">🛍️</div>`;
                itemsHtml += `
                    <div style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid rgba(0,0,0,0.05);" id="drawer-item-${item.product_id}">
                        ${imgHtml}
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:0.85rem;font-weight:600;color:#1a1a2e;margin-bottom:3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${item.title}</div>
                            <div style="font-size:0.875rem;font-weight:800;color:#e94560;margin-bottom:8px;">$${parseFloat(item.price).toFixed(2)}</div>
                            <div style="display:flex;align-items:center;gap:0;background:#f4f6f9;border-radius:8px;width:fit-content;">
                                <button onclick="updateQtyAjax(${item.product_id}, ${item.quantity - 1})" style="width:28px;height:28px;border:none;background:transparent;cursor:pointer;font-size:0.9rem;color:#6b7280;border-radius:8px 0 0 8px;display:flex;align-items:center;justify-content:center;">−</button>
                                <span style="min-width:28px;text-align:center;font-size:0.85rem;font-weight:700;color:#1a1a2e;">${item.quantity}</span>
                                <button onclick="updateQtyAjax(${item.product_id}, ${item.quantity + 1})" style="width:28px;height:28px;border:none;background:transparent;cursor:pointer;font-size:0.9rem;color:#6b7280;border-radius:0 8px 8px 0;display:flex;align-items:center;justify-content:center;">+</button>
                            </div>
                        </div>
                        <button onclick="removeCartItemAjax(${item.product_id})" style="background:none;border:none;cursor:pointer;color:#dc3545;padding:6px;border-radius:6px;font-size:0.9rem;flex-shrink:0;" onmouseover="this.style.background='rgba(220,53,69,0.08)'" onmouseout="this.style.background='none'">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                `;
            });
            drawerBody.innerHTML = itemsHtml;

            const isFreeShipping = parseFloat(data.shipping) === 0;
            const progressPct = Math.min(100, (parseFloat(data.subtotal) / parseFloat(data.free_at || 100)) * 100);
            drawerFooter.innerHTML = `
                <div style="margin-bottom:10px;">
                    <div style="display:flex;justify-content:space-between;font-size:0.72rem;margin-bottom:4px;">
                        <span style="color:#a0aec0;">${"{{ __('For free shipping') }}"}</span>
                        ${isFreeShipping
                            ? '<span style="color:#10b981;font-weight:700;">${"{{ __('✓ You got free shipping!') }}"}</span>'
                            : `<span style="color:#e94560;font-weight:700;">$${(parseFloat(data.free_at||100)-parseFloat(data.subtotal)).toFixed(2)} ${"{{ __('left') }}"}</span>`
                        }
                    </div>
                    <div style="height:4px;background:#f0f0f0;border-radius:4px;overflow:hidden;">
                        <div style="height:100%;width:${progressPct}%;background:linear-gradient(90deg,#e94560,#ff758c);border-radius:4px;transition:width 0.4s ease;"></div>
                    </div>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:4px;">
                    <span style="font-size:0.85rem;color:#6b7280;">${"{{ __('Subtotal') }}"}</span>
                    <span style="font-size:0.85rem;font-weight:600;">$${data.subtotal}</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                    <span style="font-size:0.85rem;color:#6b7280;">${"{{ __('Shipping') }}"}</span>
                    <span style="font-size:0.85rem;font-weight:600;color:${isFreeShipping?'#10b981':'#1a1a2e'}">${isFreeShipping?'${"{{ __('Free') }}"}':'$'+data.shipping}</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding-top:10px;border-top:1px solid rgba(0,0,0,0.06);margin-bottom:14px;">
                    <span style="font-size:1rem;font-weight:800;color:#1a1a2e;">${"{{ __('Total') }}"}</span>
                    <span style="font-size:1.1rem;font-weight:800;color:#e94560;">$${data.total}</span>
                </div>
                <div style="display:flex;gap:8px;">
                    <a href="{{ route('cart') }}" style="flex:1;display:flex;align-items:center;justify-content:center;padding:10px;border:1px solid rgba(0,0,0,0.1);border-radius:8px;font-size:0.875rem;font-weight:600;color:#1a1a2e;text-decoration:none;" onclick="toggleCartDrawer(false)">${"{{ __('Go to Cart') }}"}</a>
                    <a href="{{ route('checkout') }}" style="flex:2;display:flex;align-items:center;justify-content:center;padding:10px;background:#e94560;border-radius:8px;font-size:0.875rem;font-weight:700;color:#fff;text-decoration:none;"><i class="bi bi-credit-card me-2"></i>${"{{ __('Proceed to Checkout') }}"}</a>
                </div>
            `;
        }

        // Fetch current cart contents via AJAX
        function loadCartAjax() {
            fetch('{{ route('cart.contents') }}')
                .then(res => res.json())
                .then(data => {
                    updateCartDrawerUI(data);
                })
                .catch(err => {
                    console.error('Cart load failed:', err);
                });
        }

        // Add to Cart AJAX
        function addToCartAjax(productId, quantity = 1) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            return fetch('{{ route('cart.addAjax') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateCartDrawerUI(data);
                    toggleCartDrawer(true);
                    showToast('success', data.message);
                } else {
                    showToast('error', data.message);
                }
                return data;
            });
        }

        // Update Qty AJAX
        function updateQtyAjax(productId, newQty) {
            if (newQty < 1) {
                removeCartItemAjax(productId);
                return;
            }
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('{{ route('cart.updateAjax') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: productId, quantity: newQty })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateCartDrawerUI(data);
                    if (window.location.pathname === '/cart') {
                        window.location.reload();
                    }
                } else {
                    showToast('error', data.message);
                }
            });
        }

        // Remove Item AJAX
        function removeCartItemAjax(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('{{ route('cart.removeAjax') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateCartDrawerUI(data);
                    showToast('success', data.message);
                    if (window.location.pathname === '/cart') {
                        window.location.reload();
                    }
                } else {
                    showToast('error', data.message);
                }
            });
        }

        // Quick View Function
        let currentQvProductId = null;
        function showQuickView(productId) {
            fetch(`{{ url('/api/product-quickview') }}/${productId}`)
                .then(res => res.json())
                .then(data => {
                    currentQvProductId = data.id;
                    document.getElementById('qvProductTitle').innerText = data.title;
                    document.getElementById('qvProductDescription').innerText = data.description || '';
                    document.getElementById('qvProductImage').src = data.image_url || '/assets/img/default-product.png';
                    document.getElementById('qvProductPrice').innerText = data.price + ' $';
                    document.getElementById('qvDetailLink').href = data.url;
                    
                    const originalPriceEl = document.getElementById('qvProductOriginalPrice');
                    const discountBadge = document.getElementById('qvProductDiscount');
                    if (data.discount > 0) {
                        originalPriceEl.innerText = data.original_price + ' $';
                        originalPriceEl.style.display = 'inline';
                        discountBadge.innerText = `%${data.discount} ${"{{ __('Discount') }}"}`;
                        discountBadge.style.display = 'inline-block';
                    } else {
                        originalPriceEl.style.display = 'none';
                        discountBadge.style.display = 'none';
                    }
                    
                    const stockEl = document.getElementById('qvProductStock');
                    stockEl.innerText = data.stock + ' ' + "{{ __('pcs') }}";
                    if (data.stock < 1) {
                        stockEl.className = 'badge bg-danger-subtle text-danger';
                        document.getElementById('qvAddToCartBtn').disabled = true;
                    } else {
                        stockEl.className = 'badge bg-success-subtle text-success';
                        document.getElementById('qvAddToCartBtn').disabled = false;
                    }
                    
                    document.getElementById('qvQuantity').value = 1;
                    
                    const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                    modal.show();
                });
        }

        // Live Search Autocomplete Function
        let searchTimeout = null;
        function handleSearchAutocomplete(inputEl, resultsEl) {
            inputEl.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();
                if (query.length < 2) {
                    resultsEl.style.display = 'none';
                    resultsEl.innerHTML = '';
                    return;
                }
                searchTimeout = setTimeout(() => {
                    fetch(`{{ url('/api/search-autocomplete') }}?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.length === 0) {
                                resultsEl.innerHTML = '<div class="p-3 text-muted text-center small">${"{{ __('No results found.') }}"}</div>';
                            } else {
                                let html = '';
                                data.forEach(p => {
                                    html += `
                                        <a href="${p.url}" class="search-autocomplete-item">
                                            <img src="${p.image_url || '/assets/img/default-product.png'}" class="search-autocomplete-image">
                                            <div class="flex-grow-1 overflow-hidden" style="min-width:0;">
                                                <div class="search-autocomplete-title">${p.title}</div>
                                                <div class="search-autocomplete-price">${p.price} $ ${p.discount > 0 ? `<span class="text-muted text-decoration-line-through ms-1 small" style="font-size:0.75rem;">${p.original_price} $</span>` : ''}</div>
                                            </div>
                                        </a>
                                    `;
                                });
                                resultsEl.innerHTML = html;
                            }
                            resultsEl.style.display = 'block';
                        });
                }, 300);
            });
            
            document.addEventListener('click', function(e) {
                if (!inputEl.contains(e.target) && !resultsEl.contains(e.target)) {
                    resultsEl.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Setup Autocomplete on Search input
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                const resultsContainer = document.createElement('div');
                resultsContainer.className = 'search-autocomplete-results';
                searchInput.parentNode.style.position = 'relative';
                searchInput.parentNode.appendChild(resultsContainer);
                handleSearchAutocomplete(searchInput, resultsContainer);
            }

            // Quick View Add To Cart
            const qvAddBtn = document.getElementById('qvAddToCartBtn');
            if (qvAddBtn) {
                qvAddBtn.addEventListener('click', () => {
                    const qty = parseInt(document.getElementById('qvQuantity').value) || 1;
                    if (currentQvProductId) {
                        addToCartAjax(currentQvProductId, qty).then(() => {
                            const modalEl = document.getElementById('quickViewModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) modal.hide();
                        });
                    }
                });
            }

            // Intercept standard Add to Cart forms in products list and make them AJAX
            document.body.addEventListener('submit', function(e) {
                if (e.target.action && e.target.action.includes('/cart/add')) {
                    // Check if it has class "ajax-cart-form"
                    const isAjax = e.target.classList.contains('ajax-cart-form') || e.target.querySelector('input[name="product_id"]');
                    if (isAjax) {
                        e.preventDefault();
                        const pId = e.target.querySelector('input[name="product_id"]').value;
                        const qtyEl = e.target.querySelector('input[name="quantity"]');
                        const qty = qtyEl ? parseInt(qtyEl.value) : 1;
                        addToCartAjax(pId, qty);
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
