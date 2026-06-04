<style>
    /* ── Premium Footer ──────────────────────────── */
    .premium-footer {
        background: linear-gradient(135deg, #0d0c12 0%, #1a1a2e 50%, #16213e 100%);
        position: relative;
        overflow: hidden;
    }
    .premium-footer::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.04) 1px, transparent 0);
        background-size: 28px 28px;
        pointer-events: none;
    }
    .premium-footer::after {
        content: '';
        position: absolute;
        bottom: -80px; right: -80px;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(233,69,96,0.12) 0%, transparent 70%);
        pointer-events: none;
    }
    .footer-glow {
        position: absolute;
        top: -60px; left: -60px;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%);
        pointer-events: none;
    }
    .footer-brand {
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: -0.5px;
    }
    .footer-brand .brand-a { color: #e94560; }
    .footer-brand .brand-b { color: #ffffff; }
    .footer-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
        border: none;
    }
    .footer-link {
        color: rgba(255,255,255,0.5) !important;
        text-decoration: none !important;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .footer-link:hover {
        color: #e94560 !important;
        transform: translateX(4px);
    }
    .footer-heading {
        color: rgba(255,255,255,0.9);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }
    .footer-heading::after {
        content: '';
        display: block;
        width: 28px;
        height: 2px;
        background: linear-gradient(90deg, #e94560, #ff758c);
        margin-top: 6px;
        border-radius: 2px;
    }
    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: rgba(255,255,255,0.5);
        font-size: 0.875rem;
        margin-bottom: 0.8rem;
    }
    .footer-contact-item .icon-wrap {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(233,69,96,0.12);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #e94560;
        flex-shrink: 0;
        font-size: 0.8rem;
    }
    .footer-social-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.6);
        background: rgba(255,255,255,0.04);
    }
    .footer-social-btn:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 8px 20px rgba(233,69,96,0.3);
        background: linear-gradient(135deg, #e94560, #ff758c);
        border-color: transparent;
        color: #ffffff;
    }
    .footer-newsletter-input {
        background: rgba(255,255,255,0.06) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        border-radius: 12px 0 0 12px !important;
        color: #ffffff !important;
        font-size: 0.875rem !important;
        padding: 0.65rem 1rem !important;
        transition: all 0.3s ease !important;
    }
    .footer-newsletter-input::placeholder { color: rgba(255,255,255,0.3) !important; }
    .footer-newsletter-input:focus {
        background: rgba(255,255,255,0.1) !important;
        border-color: #e94560 !important;
        box-shadow: none !important;
        outline: none;
    }
    .footer-newsletter-btn {
        background: linear-gradient(135deg, #e94560, #ff758c) !important;
        border: none !important;
        border-radius: 0 12px 12px 0 !important;
        color: #fff !important;
        padding: 0 1.2rem !important;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
    }
    .footer-newsletter-btn:hover {
        opacity: 0.9;
        box-shadow: 0 4px 15px rgba(233,69,96,0.4);
    }
    .footer-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        padding: 5px 10px;
        color: rgba(255,255,255,0.45);
        font-size: 0.75rem;
    }
    .footer-bottom-text {
        color: rgba(255,255,255,0.35);
        font-size: 0.8rem;
    }
</style>

<footer class="premium-footer pt-5 pb-0">
    <div class="footer-glow"></div>
    <div class="container-fluid px-4 px-lg-5" style="position: relative; z-index: 1;">
        <div class="row g-5 mb-4">

            {{-- Brand Column --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-3">
                    <span class="brand-a">Azura</span><span class="brand-b">Shop</span>
                </div>
                <p class="mb-4" style="color: rgba(255,255,255,0.45); font-size: 0.9rem; line-height: 1.7; max-width: 300px;">
                    {{ __('Your trusted e-commerce platform offering the best products at the most affordable prices.') }}
                </p>
                <div class="d-flex gap-2 mb-4">
                    <a href="#" class="footer-social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="footer-social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="footer-social-btn" title="X"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="footer-social-btn" title="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="footer-social-btn" title="Pinterest"><i class="bi bi-pinterest"></i></a>
                </div>
                {{-- Trust badges --}}
                <div class="d-flex gap-2 flex-wrap">
                    <span class="footer-badge"><i class="bi bi-shield-check text-success"></i> {{ __('SSL Secure') }}</span>
                    <span class="footer-badge"><i class="bi bi-award text-warning"></i> {{ __('Certified') }}</span>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-heading">{{ __('Quick Links') }}</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3"><a href="{{ route('front.home') }}" class="footer-link"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>{{ __('Home') }}</a></li>
                    <li class="mb-3"><a href="{{ route('shop.index') }}" class="footer-link"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>{{ __('Products') }}</a></li>
                    <li class="mb-3"><a href="{{ route('cart') }}" class="footer-link"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>{{ __('Cart') }}</a></li>
                    <li class="mb-3"><a href="{{ route('login') }}" class="footer-link"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>{{ __('Login') }}</a></li>
                    @auth<li class="mb-3"><a href="{{ route('profile') }}" class="footer-link"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>{{ __('My Profile') }}</a></li>@endauth
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-3 col-md-3 col-6">
                <h6 class="footer-heading">{{ __('Contact') }}</h6>
                <div class="footer-contact-item">
                    <span class="icon-wrap"><i class="bi bi-geo-alt-fill"></i></span>
                    <span>Istanbul, Turkey</span>
                </div>
                <div class="footer-contact-item">
                    <span class="icon-wrap"><i class="bi bi-telephone-fill"></i></span>
                    <span>+90 555 123 4567</span>
                </div>
                <div class="footer-contact-item">
                    <span class="icon-wrap"><i class="bi bi-envelope-fill"></i></span>
                    <span>contact@azurashop.com</span>
                </div>
                <div class="footer-contact-item">
                    <span class="icon-wrap"><i class="bi bi-clock-fill"></i></span>
                    <span>{{ __('Mon–Sat, 09:00–18:00') }}</span>
                </div>
            </div>

            {{-- Newsletter --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">{{ __('Subscribe to our Newsletter') }}</h6>
                <p style="color: rgba(255,255,255,0.45); font-size: 0.875rem; line-height: 1.6;" class="mb-3">
                    {{ __('Subscribe to our newsletter for new products and campaigns.') }}
                </p>
                <div class="input-group mb-3">
                    <input type="email" class="form-control footer-newsletter-input"
                           placeholder="{{ __('Your email address') }}">
                    <button class="btn footer-newsletter-btn" type="button">
                        <i class="bi bi-send-fill"></i> {{ __('Subscribe') }}
                    </button>
                </div>
                <p style="color: rgba(255,255,255,0.25); font-size: 0.75rem;">
                    <i class="bi bi-lock-fill me-1"></i> {{ __('We do not spam. Unsubscribe anytime.') }}
                </p>
            </div>

        </div>

        <hr class="footer-divider my-0">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-4 gap-3">
            <p class="footer-bottom-text mb-0">
                &copy; {{ date('Y') }} <span style="color:#e94560; font-weight:600;">AzuraShop</span>. {{ __('All rights reserved.') }}
            </p>
            {{-- Payment icons --}}
            <div class="d-flex align-items-center gap-3">
                <span style="color:rgba(255,255,255,0.25); font-size:0.75rem;">{{ __('Payment Methods:') }}</span>
                <div class="d-flex gap-2">
                    <span class="footer-badge p-1 px-2"><i class="bi bi-credit-card-2-front fs-5"></i></span>
                    <span class="footer-badge p-1 px-2"><i class="bi bi-paypal fs-5" style="color:#0070ba;"></i></span>
                    <span class="footer-badge p-1 px-2"><i class="bi bi-cash-coin fs-5" style="color:#28a745;"></i></span>
                    <span class="footer-badge p-1 px-2"><i class="bi bi-shield-lock-fill fs-5" style="color:#6366f1;"></i></span>
                </div>
            </div>
        </div>
    </div>
</footer>
