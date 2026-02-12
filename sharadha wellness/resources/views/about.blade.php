@extends('spa::layouts.app')

@section('title', 'About Us - Shadhara Wellness')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>About Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('spa.home') }}" itemprop="item">
                        <span itemprop="name">Home</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li class="active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">About Us</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="about-page">
    <div class="container">
        <div class="about-content-full">
            <div class="about-image">
                <img src="{{ asset('spa-assets/images/about/about.jpg') }}" alt="Shadhara Wellness" loading="lazy">
            </div>
            <div class="about-text-full">
                <h2>Healing Rooted in Ceylonese Ayurvedic</h2>
                <p>At Shadhara Wellnesss, your healing journey begins the moment you arrive. We provide dedicated care with personalized attention from our residential doctor and offer complimentary guided tours, thoughtfully tailored to your treatment package.</p>
                
                <div class="about-features">
                    <div class="feature-box">
                        <h3>Traditional Wellness</h3>
                        <p>Rooted in generations of traditional healing, Shadhara Wellness follows time-tested Ceylon Ayurveda practices passed down through ancient lineages. Our treatments are based on centuries-old wisdom that has been proven effective for natural healing and rejuvenation.</p>
                    </div>
                    
                    <div class="feature-box">
                        <h3>Expert Ayurvedic Doctors</h3>
                        <p>Our team of experienced Ayurvedic doctors brings years of expertise in traditional healing. They provide personalized consultations and treatments tailored to your unique body constitution and health needs, ensuring the most effective healing experience.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-section">
            <div class="stat-item" data-count="15" data-suffix="+">
                <h3 class="stat-number">0+</h3>
                <p>Ayurvedic Doctors</p>
            </div>
            <div class="stat-item stat-highlight" data-count="100" data-suffix="%">
                <h3 class="stat-number">0%</h3>
                <p>Ayurvedic Process</p>
            </div>
            <div class="stat-item" data-count="500" data-suffix="+">
                <h3 class="stat-number">0+</h3>
                <p>Satisfied Clients</p>
            </div>
            <div class="stat-item" data-count="20" data-suffix="+">
                <h3 class="stat-number">0+</h3>
                <p>Specialists Team</p>
            </div>
        </div>

        <div class="mission-vision">
            <div class="mission">
                <h2>Our Mission</h2>
                <p>To provide authentic Ayurvedic healing experiences that restore balance, promote natural rejuvenation, and help individuals achieve inner peace through time-tested Ceylonese wellness traditions.</p>
            </div>
            <div class="vision">
                <h2>Our Vision</h2>
                <p>To be the leading Ayurvedic wellness center in Sri Lanka, recognized for our commitment to traditional healing practices and personalized care that transforms lives.</p>
            </div>
        </div>
    </div>
</section>

<!-- Doctors Section -->
@if(isset($doctors) && $doctors->count() > 0)
<section class="doctors-section">
    <div class="container">
        <div class="section-header fade-in-up">
            <div class="title-shape"></div>
            <h2>Meet Our Expert Ayurvedic Doctors</h2>
            <p>Our experienced team of Ayurvedic physicians brings years of expertise in traditional healing</p>
        </div>
        <div class="doctors-list">
            @foreach($doctors as $index => $doctor)
            <div class="doctor-profile fade-in-up {{ $index < count($doctors) - 1 ? 'has-divider' : '' }}">
                <div class="doctor-image-wrapper">
                    <div class="doctor-decorative-bg">
                        <div class="decorative-pattern"></div>
                    </div>
                    <div class="doctor-image-circle">
                        @if($doctor->image)
                            <img src="{{ asset('spa-assets/images/doctors/' . $doctor->image) }}" alt="{{ $doctor->name }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('spa-assets/images/doctors/default-doctor.jpg') }}';">
                        @else
                            <div class="doctor-placeholder">
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">{{ $doctor->name }}</h3>
                    @if($doctor->title)
                    <p class="doctor-title">{{ $doctor->title }}</p>
                    @endif
                    @if($doctor->bio)
                    <p class="doctor-bio">{{ $doctor->bio }}</p>
                    @else
                        @if($doctor->qualifications)
                        <p class="doctor-qualifications">{{ $doctor->qualifications }}</p>
                        @endif
                        @if($doctor->specialization)
                        <p class="doctor-specialization">{{ $doctor->specialization }}</p>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection


