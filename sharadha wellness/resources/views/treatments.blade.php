@extends('spa::layouts.app')

@section('title', 'Our Ayurvedic Treatments - Shadhara Wellness')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Our Ayurvedic Treatments</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('spa.home') }}" itemprop="item">
                        <span itemprop="name">Home</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li class="active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">Our Ayurvedic Treatments</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="treatments-page">
    <div class="container">
        <div class="section-header">
            <div class="title-shape"></div>
            <h2>Traditional Spa and Beauty Service</h2>
            <p>Experience the healing power of ancient Ceylon Ayurveda through our comprehensive range of treatments</p>
        </div>
        
        <div class="treatments-grid">
            @foreach($treatments as $treatment)
            <div class="treatment-card">
                <div class="treatment-image">
                    <img src="{{ asset('spa-assets/images/treatments/' . $treatment->image) }}" alt="{{ $treatment->name }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('spa-assets/images/treatments/treatments.jpg') }}';">
                </div>
                <div class="treatment-content">
                    <h3>{{ $treatment->name }}</h3>
                    <p>{{ $treatment->description }}</p>
                    @if($treatment->duration)
                    <div class="treatment-meta">
                        <span class="duration">Duration: {{ $treatment->duration }} minutes</span>
                    </div>
                    @endif
                    <div class="treatment-price">
                        <span class="price">$ {{ number_format($treatment->price, 2) }}</span>
                    </div>
                    <a href="{{ route('spa.pricing') }}" class="btn-primary">Book Now</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection


