<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Admin Panel')) — AzuraShop</title>

    {{-- Dark Mode Immediate Execution Script --}}
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
                document.documentElement.classList.add('dark-mode');
            } else {
                document.documentElement.setAttribute('data-bs-theme', 'light');
                document.documentElement.classList.remove('dark-mode');
            }
        })();
    </script>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    {{-- OverlayScrollbars --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
    {{-- AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.css') }}" />

    <style>
        :root {
            --lte-sidebar-width: 260px;
        }
        .sidebar-brand-text { font-weight: 700; font-size: 1.25rem; letter-spacing: .5px; }
        .small-box { border-radius: 12px; }
        .card { border-radius: 10px; }
        .badge-status { font-size: .75rem; padding: .35em .65em; border-radius: 50rem; }
        .table th { font-size: .8rem; text-transform: uppercase; letter-spacing: .05em; color: #6c757d; border-top: none; }
        .btn-action { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: .85rem; }
        img.thumb { width: 48px; height: 48px; object-fit: cover; border-radius: 8px; }
        .alert { border-radius: 10px; border: none; }

        /* Smooth Dark Mode Transition */
        body, nav, aside, .card, .modal-content, .table, th, td, h1, h2, h3, h4, h5, h6, p, a, button, input, select, textarea, span {
            transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease, fill 0.25s ease !important;
        }
    </style>

    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    {{-- ── Header ─────────────────────────────────────────────── --}}
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list fs-5"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a href="{{ route('front.home') }}" class="nav-link" target="_blank">
                        <i class="bi bi-globe me-1"></i> {{ __('View Store') }}
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                {{-- Clock --}}
                <li class="nav-item d-none d-sm-block">
                    <span class="nav-link text-muted small">
                        <i class="bi bi-clock me-1"></i>{{ now()->format('d.m.Y H:i') }}
                    </span>
                </li>

                {{-- Language Selector --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" data-bs-toggle="dropdown" id="langSelector">
                        <i class="bi bi-translate text-muted"></i>
                        <span class="text-uppercase">{{ app()->getLocale() }}</span>
                    </a>
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
                </li>

                {{-- Dark Mode Toggle --}}
                <li class="nav-item">
                    <button id="darkModeToggle" class="nav-link btn border-0 bg-transparent shadow-none" title="{{ __('Toggle Dark Mode') }}">
                        <i class="bi bi-moon-stars" style="font-size: 1.1rem;"></i>
                    </button>
                </li>

                {{-- User Dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white"
                             style="width:32px;height:32px;font-size:.85rem;font-weight:600;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px;">
                        <li><h6 class="dropdown-header">{{ auth()->user()->email }}</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    {{-- ── Sidebar ─────────────────────────────────────────────── --}}
    <aside class="app-sidebar bg-dark sidebar-dark-primary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="{{ route('admin.home') }}" class="brand-link px-3 py-3 d-flex align-items-center gap-2 text-decoration-none">
                <div class="bg-primary rounded-2 d-flex align-items-center justify-content-center"
                     style="width:36px;height:36px;">
                    <i class="bi bi-shop text-white fs-5"></i>
                </div>
                <span class="sidebar-brand-text text-white">AzuraShop</span>
                <span class="badge bg-primary ms-1" style="font-size:.6rem;">ADMIN</span>
            </a>
        </div>

        <div class="sidebar-wrapper" data-overlayscrollbars-initialize>
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">

                    {{-- Dashboard --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}"
                           class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>{{ __('Dashboard') }}</p>
                        </a>
                    </li>

                    <li class="nav-header text-uppercase" style="font-size:.65rem;letter-spacing:.1em;padding:.5rem 1rem;color:#6c757d;">
                        {{ __('Catalog') }}
                    </li>

                    {{-- Categories --}}
                    <li class="nav-item {{ request()->routeIs('admin.categories.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-grid"></i>
                            <p>{{ __('Categories') }} <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-list-ul"></i>
                                    <p>{{ __('All Categories') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.create') }}"
                                   class="nav-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-plus-circle"></i>
                                    <p>{{ __('New Category') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Products --}}
                    <li class="nav-item {{ request()->routeIs('admin.products.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-box-seam"></i>
                            <p>{{ __('Products') }} <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-list-ul"></i>
                                    <p>{{ __('All Products') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.create') }}"
                                   class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-plus-circle"></i>
                                    <p>{{ __('New Product') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header text-uppercase" style="font-size:.65rem;letter-spacing:.1em;padding:.5rem 1rem;color:#6c757d;">
                        {{ __('Sales') }}
                    </li>

                    {{-- Orders --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}"
                           class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-bag-check"></i>
                            <p>{{ __('Orders') }}</p>
                        </a>
                    </li>

                    <li class="nav-header text-uppercase" style="font-size:.65rem;letter-spacing:.1em;padding:.5rem 1rem;color:#6c757d;">
                        {{ __('Management') }}
                    </li>

                    {{-- Users --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people"></i>
                            <p>{{ __('Users') }}</p>
                        </a>
                    </li>

                    {{-- Sliders --}}
                    <li class="nav-item {{ request()->routeIs('admin.sliders.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-images"></i>
                            <p>{{ __('Slider') }} <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.sliders.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.sliders.index') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-list-ul"></i>
                                    <p>{{ __('Slider List') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sliders.create') }}"
                                   class="nav-link {{ request()->routeIs('admin.sliders.create') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-plus-circle"></i>
                                    <p>{{ __('New Slider') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    {{-- ── Main Content ────────────────────────────────────────── --}}
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0 fw-semibold">@yield('page_title', 'Dashboard')</h4>
                    </div>
                    <div class="col-auto">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>{{ __('Error! Please correct the errors in the form.') }}</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>

    {{-- ── Footer ──────────────────────────────────────────────── --}}
    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline text-muted small">
            Laravel {{ app()->version() }}
        </div>
        <strong class="text-muted small">
            <i class="bi bi-shop me-1"></i> AzuraShop Admin Panel &copy; {{ date('Y') }}
        </strong>
    </footer>

</div><!-- /.app-wrapper -->

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es5.min.js"></script>
<script src="{{ asset('assets/admin/js/adminlte.js') }}"></script>

{{-- Dark Mode Toggle Logic --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('darkModeToggle');
        if (toggleBtn) {
            const icon = toggleBtn.querySelector('i');
            
            const updateToggleUI = (isDark) => {
                if (isDark) {
                    icon.className = 'bi bi-sun';
                } else {
                    icon.className = 'bi bi-moon-stars';
                }
            };

            const isDarkModeActive = document.documentElement.getAttribute('data-bs-theme') === 'dark' || document.documentElement.classList.contains('dark-mode');
            updateToggleUI(isDarkModeActive);

            toggleBtn.addEventListener('click', () => {
                const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
                const nextDark = !isDark;
                
                if (nextDark) {
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                    document.documentElement.classList.add('dark-mode');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                    document.documentElement.classList.remove('dark-mode');
                    localStorage.setItem('theme', 'light');
                }
                updateToggleUI(nextDark);
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>
