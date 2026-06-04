<style>
    /* Navbar styling adjustments */
    .premium-navbar {
        background-color: #ffffff !important;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    
    html.dark-mode .premium-navbar {
        background-color: #16151c !important;
        border-bottom: 1px solid rgba(255,255,255,0.06) !important;
    }
    
    /* Nav links active and hover states */
    .premium-nav-link {
        color: #4a5568 !important;
        font-weight: 500;
        font-size: 0.95rem;
        padding: 0.5rem 1.1rem !important;
        border-radius: 20px;
        transition: all 0.2s ease;
    }
    
    .premium-nav-link:hover, .premium-nav-link.active {
        color: #e94560 !important;
        background-color: rgba(233, 69, 96, 0.05);
    }
    
    html.dark-mode .premium-nav-link {
        color: #cbd5e0 !important;
    }
    
    html.dark-mode .premium-nav-link:hover, html.dark-mode .premium-nav-link.active {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    /* Sleek search input styling */
    .premium-search-box {
        position: relative;
        width: 240px;
        transition: width 0.3s ease;
    }
    
    .premium-search-box:focus-within {
        width: 270px;
    }
    
    .premium-search-input {
        background-color: #f8f9fa !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        border-radius: 30px !important;
        padding: 0.5rem 2.5rem 0.5rem 1.2rem !important;
        font-size: 0.85rem !important;
        color: #1a202c !important;
        transition: all 0.3s ease !important;
    }
    
    .premium-search-input:focus {
        background-color: #ffffff !important;
        border-color: #e94560 !important;
        box-shadow: 0 4px 12px rgba(233, 69, 96, 0.08) !important;
    }
    
    html.dark-mode .premium-search-input {
        background-color: #1d1b26 !important;
        border-color: rgba(255,255,255,0.08) !important;
        color: #ffffff !important;
    }
    
    html.dark-mode .premium-search-input:focus {
        background-color: #16151c !important;
        border-color: #e94560 !important;
        box-shadow: 0 4px 12px rgba(233, 69, 96, 0.2) !important;
    }
    
    .premium-search-btn {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        background: none !important;
        border: none !important;
        color: #e94560 !important;
        font-size: 1rem;
        cursor: pointer;
        padding: 0 8px;
        transition: opacity 0.2s ease;
        z-index: 5;
    }
    
    .premium-search-btn:hover {
        opacity: 0.8;
    }
    
    /* Icon Buttons (Cart, Theme) */
    .premium-icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 50% !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        background-color: #ffffff !important;
        color: #4a5568 !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        transition: all 0.2s ease;
        cursor: pointer;
        padding: 0 !important;
    }
    
    .premium-icon-btn:hover {
        background-color: #f8f9fa !important;
        color: #e94560 !important;
        border-color: #e94560 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    
    html.dark-mode .premium-icon-btn {
        background-color: #16151c !important;
        border-color: rgba(255,255,255,0.08) !important;
        color: #cbd5e0 !important;
    }
    
    html.dark-mode .premium-icon-btn:hover {
        background-color: #1d1b26 !important;
        color: #ffffff !important;
        border-color: #e94560 !important;
        box-shadow: 0 4px 10px rgba(255,255,255,0.02);
    }
    
    /* Floating badge for cart */
    .premium-cart-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: linear-gradient(135deg, #e94560 0%, #ff758c 100%) !important;
        color: #ffffff !important;
        font-size: 0.65rem !important;
        font-weight: 700;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 5px rgba(233, 69, 96, 0.3);
    }
    
    html.dark-mode .premium-cart-badge {
        border-color: #16151c;
    }
    
    /* Language dropdown button overrides */
    .premium-lang-btn {
        border-radius: 20px !important;
        font-size: 0.8rem !important;
        font-weight: 600 !important;
        height: 38px;
        padding: 0 14px !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: #ffffff !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        color: #4a5568 !important;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .premium-lang-btn:hover {
        background-color: #f8f9fa !important;
        border-color: #e94560 !important;
        color: #e94560 !important;
        transform: translateY(-2px);
    }
    
    html.dark-mode .premium-lang-btn {
        background-color: #16151c !important;
        border-color: rgba(255,255,255,0.08) !important;
        color: #cbd5e0 !important;
    }
    
    html.dark-mode .premium-lang-btn:hover {
        background-color: #1d1b26 !important;
        color: #ffffff !important;
        border-color: #e94560 !important;
    }
    
    /* Login & Register Buttons */
    .btn-premium-login {
        color: #4a5568 !important;
        font-weight: 600;
        font-size: 0.875rem !important;
        padding: 0.55rem 1.4rem !important;
        border-radius: 8px !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        background: transparent !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 0.3px;
    }
    
    .btn-premium-login:hover {
        color: #1a202c !important;
        background-color: #f8f9fa !important;
        border-color: rgba(0, 0, 0, 0.15) !important;
    }
    
    html.dark-mode .btn-premium-login {
        color: #cbd5e0 !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
    }
    
    html.dark-mode .btn-premium-login:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.05) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
    }
    
    .btn-premium-register {
        background: #e94560 !important;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.875rem !important;
        padding: 0.55rem 1.4rem !important;
        border-radius: 8px !important;
        border: 1px solid #e94560 !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 0.3px;
    }
    
    .btn-premium-register:hover {
        background-color: #d63350 !important;
        border-color: #d63350 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(233, 69, 96, 0.25);
    }
    
    /* Brand logo styles */
    .premium-logo {
        transition: all 0.3s ease;
    }
    .premium-logo:hover {
        transform: scale(1.03);
    }
</style>

<nav class="navbar navbar-expand-lg premium-navbar shadow-sm sticky-top">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand fw-bold fs-4 premium-logo" href="{{ route('front.home') }}" style="color:#1a1a2e;">
            <span style="color:#e94560;">Azura</span>Shop
        </a>

        {{-- Mobile toggle --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            {{-- Nav Links --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-1">
                <li class="nav-item">
                    <a class="nav-link premium-nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}"
                       href="{{ route('front.home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link premium-nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}"
                       href="{{ route('shop.index') }}">{{ __('Products') }}</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3 ms-auto flex-wrap justify-content-end">
                {{-- Search Form --}}
                <form action="{{ route('shop.index') }}" method="GET" class="m-0">
                    <div class="premium-search-box">
                        <input class="form-control premium-search-input" type="search" name="search"
                               placeholder="{{ __('Search products...') }}" value="{{ request('search') }}">
                        <button class="premium-search-btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                {{-- Cart Icon --}}
                <a href="{{ route('cart') }}" onclick="event.preventDefault(); toggleCartDrawer(true);" 
                   class="premium-icon-btn" title="{{ __('Cart') }}">
                    <i class="bi bi-cart3" style="font-size: 1.15rem;"></i>
                    @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                    <span class="cart-badge premium-cart-badge" style="display: {{ $cartCount > 0 ? 'inline-flex' : 'none' }}">{{ $cartCount }}</span>
                </a>

                {{-- Language Selector --}}
                <div class="dropdown">
                    <button class="premium-lang-btn dropdown-toggle border-0" data-bs-toggle="dropdown" id="langSelector">
                        <i class="bi bi-translate text-muted"></i>
                        <span class="text-uppercase">{{ app()->getLocale() }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px; min-width: 120px; margin-top: 8px;">
                        <li>
                            <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('lang.switch', 'en') }}">
                                <span>🇬🇧 EN</span>
                                @if(app()->getLocale() == 'en') <i class="bi bi-check text-success"></i> @endif
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('lang.switch', 'es') }}">
                                <span>🇪🇸 ES</span>
                                @if(app()->getLocale() == 'es') <i class="bi bi-check text-success"></i> @endif
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center justify-content-between py-2" href="{{ route('lang.switch', 'tr') }}">
                                <span>🇹🇷 TR</span>
                                @if(app()->getLocale() == 'tr') <i class="bi bi-check text-success"></i> @endif
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Dark Mode Toggle --}}
                <button id="darkModeToggle" class="premium-icon-btn" title="{{ __('Toggle Dark Mode') }}">
                    <i class="bi bi-moon-stars" style="font-size: 1.1rem;"></i>
                </button>

                {{-- Auth --}}
                @auth
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-dark dropdown-toggle px-3" style="border-radius:8px; font-weight: 500; height:38px; display:inline-flex; align-items:center; gap:6px;"
                                data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>{{ Str::limit(auth()->user()->name, 12) }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px; margin-top: 8px;">
                            @if(auth()->user()->isAdmin())
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('admin.home') }}">
                                        <i class="bi bi-shield-fill me-2 text-danger"></i>{{ __('Admin Panel') }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile') }}">
                                    <i class="bi bi-person-fill me-2 text-primary"></i>{{ __('My Profile / Orders') }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('login') }}" class="btn-premium-login text-decoration-none">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="btn-premium-register text-decoration-none">
                            {{ __('Register') }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
