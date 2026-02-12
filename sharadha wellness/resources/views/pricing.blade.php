@extends('spa::layouts.app')

@section('title', 'Pricing Plan - Shadhara Wellness')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Pricing Plan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('spa.home') }}" itemprop="item">
                        <span itemprop="name">Home</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li class="active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">Pricing Plan</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="pricing-page">
    <div class="container">
        <div class="section-header">
            <div class="title-shape"></div>
            <h2>Explore Our Wellness Packages for Natural Beauty</h2>
            <p>Ayurvedic beauty rituals using herbs, oils, and ancient techniques that purify, nourish, and rejuvenate your skin, hair, and body from within.</p>
        </div>

        <div class="pricing-grid">
            @foreach($treatments as $treatment)
            <div class="pricing-card-full">
                <div class="pricing-image">
                    <img src="{{ asset('spa-assets/images/treatments/' . $treatment->image) }}" alt="{{ $treatment->name }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('spa-assets/images/treatments/treatments.jpg') }}';">
                </div>
                <div class="pricing-content">
                    <h3>{{ $treatment->name }}</h3>
                    <p>{{ $treatment->description }}</p>
                    @if($treatment->duration)
                    <div class="pricing-meta">
                        <span>Duration: {{ $treatment->duration }} minutes</span>
                    </div>
                    @endif
                    <div class="pricing-price">
                        <span class="price">$ {{ number_format($treatment->price, 2) }}</span>
                        <span class="discount">20% OFF</span>
                    </div>
                    <a href="{{ route('spa.contact') }}" class="btn-primary">Book Now</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="discount-banner">
            <h2>Relax Anytime Any Day At 20% Discount</h2>
            <p>Book your appointment today and enjoy our special discount offer</p>
            <a href="{{ route('spa.contact') }}" class="btn-primary">Make An Appointment</a>
        </div>
    </div>
</section>
@endsection


