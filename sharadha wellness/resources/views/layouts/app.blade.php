<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Shadhara Wellness - Embracing Ancient Ceylon Healing')</title>
    <meta name="description" content="@yield('description', 'Shadhara Wellness - Embracing Ancient Ceylon Healing for Natural Rejuvenation, Balance, and Inner Peace.')">
    
    <link rel="stylesheet" href="{{ asset('spa-assets/css/app.css') }}">
    <script src="{{ asset('spa-assets/js/app.js') }}" defer></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preload" href="{{ asset('spa-assets/images/logo.png') }}" as="image">
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="{{ route('spa.home') }}" title="Shadhara Wellness - Home" class="logo-link">
                        <img src="{{ asset('spa-assets/images/shadhara-logo.png') }}" alt="Shadhara Wellness Logo" class="logo-img" onerror="this.onerror=null; this.src='{{ asset('spa-assets/images/logo.png') }}';">
                    </a>
                </div>
                <ul class="nav-menu" role="menubar">
                    <li role="none"><a href="{{ route('spa.home') }}" class="{{ request()->routeIs('spa.home') ? 'active' : '' }}" role="menuitem" aria-label="Home">Home</a></li>
                    <li role="none"><a href="{{ route('spa.about') }}" class="{{ request()->routeIs('spa.about') ? 'active' : '' }}" role="menuitem" aria-label="About Us">About Us</a></li>
                    <li role="none"><a href="{{ route('spa.treatments') }}" class="{{ request()->routeIs('spa.treatments') ? 'active' : '' }}" role="menuitem" aria-label="Our Ayurvedic Treatments">Our Ayurvedic Treatments</a></li>
                    <li role="none"><a href="{{ route('spa.pricing') }}" class="{{ request()->routeIs('spa.pricing') ? 'active' : '' }}" role="menuitem" aria-label="Pricing Plan">Pricing Plan</a></li>
                    <li role="none"><a href="{{ route('spa.contact') }}" class="{{ request()->routeIs('spa.contact') ? 'active' : '' }}" role="menuitem" aria-label="Contact Us">Contact Us</a></li>
                </ul>
                <div class="nav-contact">
                    <a href="tel:+94714831035" class="phone-link">+94 71 483 1035</a>
                    <a href="{{ route('spa.contact') }}" class="btn-book"><span>Book Now</span></a>
                </div>
                <button class="hamburger" aria-label="Toggle navigation menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content" role="main">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('newsletter_success'))
            <div class="alert alert-success">
                {{ session('newsletter_success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Shadhara Wellness</h3>
                    <p>Embracing Ancient Ceylon Healing for Natural Rejuvenation, Balance, and Inner Peace.</p>
                    <p class="hours"><strong>We Are Available:</strong><br>Mon-Sat: 08.00 am to 5.00 pm</p>
                </div>
                <div class="footer-section">
                    <h4>Quick link</h4>
                    <ul>
                        <li><a href="{{ route('spa.about') }}">About Us</a></li>
                        <li><a href="{{ route('spa.treatments') }}">Our Ayurvedic Treatments</a></li>
                        <li><a href="{{ route('spa.pricing') }}">Pricing Plan</a></li>
                        <li><a href="#">Terms and Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Details</h4>
                    <div class="contact-info">
                        <div class="contact-detail-item">
                            <h5>Phone Number</h5>
                            <p>+94 71 483 1035</p>
                        </div>
                        <div class="contact-detail-item">
                            <h5>Email Address</h5>
                            <p>reservations@goldenskyhotelandwellness.com</p>
                        </div>
                        <div class="contact-detail-item">
                            <h5>Office Location</h5>
                            <p>53/1, Hanthana housing scheme, Kandy</p>
                        </div>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Newsletter</h4>
                    <p>Sign Up to get updates & news about us. Get Latest Updates and package offers to your email address.</p>
                    <form action="{{ route('spa.newsletter.store') }}" method="POST" class="newsletter-form" id="newsletterForm">
                        @csrf
                        <div class="newsletter-input-wrapper">
                            <input type="email" name="email" id="newsletter-email" placeholder="Your Email Address" required>
                            <div class="newsletter-error" id="newsletter-error"></div>
                        </div>
                        <button type="submit" id="newsletter-submit">
                            <span class="button-text">Subscribe Now</span>
                            <span class="button-loader" style="display: none;">Subscribing...</span>
                        </button>
                    </form>
                    <div class="newsletter-success" id="newsletter-success" style="display: none;"></div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; {{ date('Y') }} Shadhara Wellness. All Rights Reserved. Powered by Forge Software Solutions</p>
                </div>
                <div class="footer-links">
                    <a href="#">Privacy</a>
                    <span class="separator">|</span>
                    <a href="#">Terms & Condition</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>


