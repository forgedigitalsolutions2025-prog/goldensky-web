<?php $__env->startSection('title', 'Home - Golden Sky Hotel & Wellness'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="relative h-screen overflow-hidden">
    <!-- Background Video -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="<?php echo e(asset('videos/dawn-sunrise-timelapse.mp4')); ?>" type="video/mp4">
        <!-- Fallback image if video doesn't load -->
        <img src="<?php echo e(asset('images/hotel/04af6130-85c5-4a18-891d-4842c56f6183.JPG')); ?>" alt="Golden Sky Hotel" class="w-full h-full object-cover">
    </video>
    
    <!-- Gradient Overlays -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/60"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-gold/10 via-transparent to-gold/10"></div>
    
    <!-- Animated Particles/Shine Effect -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gold-dark rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <!-- Content -->
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-6 max-w-5xl z-10">
            <!-- Main Heading with Animation -->
            <h1 class="mb-10 leading-tight animate-fade-in-up">
                <span class="block mb-3 text-2xl md:text-3xl font-light text-white/90 drop-shadow-lg tracking-wider uppercase">Welcome to</span>
                <span class="block text-6xl md:text-8xl lg:text-9xl font-bold mb-2">
                    <span class="inline-block bg-gradient-to-r from-white via-gold to-white bg-clip-text text-transparent drop-shadow-2xl animate-shimmer" style="background-size: 200% auto;">Golden Sky</span>
                </span>
                <span class="block text-4xl md:text-6xl lg:text-7xl font-bold mb-4">
                    <span class="inline-block bg-gradient-to-r from-gold-light via-gold to-gold-dark bg-clip-text text-transparent drop-shadow-xl animate-shimmer" style="background-size: 200% auto; animation-delay: 0.5s;">Hotel</span>
                </span>
                <span class="block text-xl md:text-3xl lg:text-4xl font-light text-gold-light tracking-[0.3em] drop-shadow-lg uppercase">& Wellness</span>
            </h1>
            
            <!-- Description with Animation -->
            <p class="text-xl md:text-3xl lg:text-4xl mb-12 leading-relaxed font-light animate-fade-in delay-200 max-w-5xl mx-auto text-white/95 drop-shadow-2xl" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                Experience Luxury and Tranquility<br/>
                <span class="text-lg md:text-xl lg:text-2xl text-gold-light">in the Heart of Paradise</span>
            </p>
            
            <!-- Decorative Line -->
            <div class="w-32 h-1 bg-gradient-to-r from-transparent via-gold to-transparent mx-auto mb-10 animate-fade-in delay-300"></div>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-fade-in-up delay-400">
                <a href="<?php echo e(route('rooms.index')); ?>" 
                   class="group relative inline-flex items-center justify-center px-12 py-5 text-xl font-bold text-white bg-gradient-to-r from-gold via-gold-dark to-gold rounded-full transition-all duration-500 transform hover:scale-110 shadow-2xl hover:shadow-gold overflow-hidden">
                    <!-- Animated shine effect -->
                    <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></span>
                    <span class="relative z-10 flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="tracking-wide">Book Your Stay</span>
                        <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </a>
                
                <a href="<?php echo e(route('rooms.index')); ?>" 
                   class="group inline-flex items-center justify-center px-12 py-5 text-xl font-bold text-white border-3 border-white/70 hover:border-white backdrop-blur-md hover:bg-white/20 rounded-full transition-all duration-300 transform hover:scale-110 shadow-xl">
                    <span class="flex items-center space-x-3">
                        <svg class="w-6 h-6 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span class="tracking-wide">Explore Rooms</span>
                    </span>
                </a>
            </div>
            
        </div>
    </div>
</div>

<!-- Custom Animations -->
<style>
    [x-cloak] {
        display: none !important;
    }
    
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fade-in {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    
    @keyframes slow-zoom {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    
    @keyframes shimmer {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }
    
    .animate-fade-in-down {
        animation: fade-in-down 1s ease-out;
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 1s ease-out;
    }
    
    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }
    
    .animate-slow-zoom {
        animation: slow-zoom 20s ease-in-out infinite alternate;
    }
    
    .animate-shimmer {
        animation: shimmer 4s linear infinite;
    }
    
    .delay-200 {
        animation-delay: 0.2s;
        opacity: 0;
        animation-fill-mode: forwards;
    }
    
    .delay-300 {
        animation-delay: 0.3s;
        opacity: 0;
        animation-fill-mode: forwards;
    }
    
    .delay-400 {
        animation-delay: 0.4s;
        opacity: 0;
        animation-fill-mode: forwards;
    }
</style>

<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- About Our Hotel Section -->
        <div class="mb-20">
            <!-- Section Header -->
            <div class="text-center mb-12 scroll-reveal">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">About Golden Sky Hotel & Wellness</h2>
                <div class="w-24 h-1 bg-gold mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Where luxury meets tranquility in perfect harmony</p>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-8 mb-12">
                <!-- Left: Hotel Images -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="h-64 rounded-xl overflow-hidden shadow-lg">
                        <img src="<?php echo e(asset('images/hotel/088e6553-3d9d-44ee-9510-d807383a1b7d.JPG')); ?>" 
                             alt="Hotel Exterior" 
                             class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                    <div class="h-48 rounded-xl overflow-hidden shadow-lg">
                        <img src="<?php echo e(asset('images/hotel/1b3b9a71-7ee5-4625-bc9f-5165c8411094.JPG')); ?>" 
                             alt="Hotel Amenities" 
                             class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>
                </div>

                <!-- Right: Description & Features -->
                <div class="lg:col-span-2">
                    <!-- Description -->
                    <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                        <h3 class="text-2xl font-bold text-gold-dark mb-4">Experience Unparalleled Luxury</h3>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Welcome to <strong>Golden Sky Hotel & Wellness</strong>, where exceptional hospitality meets contemporary elegance. 
                            Nestled in a pristine location, our hotel offers an exclusive retreat for discerning travelers seeking 
                            the perfect blend of comfort, sophistication, and personalized service.
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Each of our meticulously designed rooms and suites reflects our commitment to excellence, featuring premium 
                            furnishings, modern amenities, and breathtaking views. Whether you're traveling for business or leisure, 
                            our dedicated team ensures every detail of your stay exceeds expectations.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Immerse yourself in our world-class wellness center, savor exquisite cuisine at our signature restaurant, 
                            or simply unwind in the tranquil ambiance that defines the Golden Sky experience.
                        </p>
                    </div>

                    <!-- Key Features Grid -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg shadow p-6 flex items-start space-x-4">
                            <div class="bg-gold-light rounded-full p-3">
                                <svg class="w-6 h-6 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">30 Luxury Rooms</h4>
                                <p class="text-sm text-gray-600">Elegantly appointed with modern comforts</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 flex items-start space-x-4">
                            <div class="bg-gold-light rounded-full p-3">
                                <svg class="w-6 h-6 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">24/7 Concierge</h4>
                                <p class="text-sm text-gray-600">Personalized service around the clock</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 flex items-start space-x-4">
                            <div class="bg-gold-light rounded-full p-3">
                                <svg class="w-6 h-6 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Premium Amenities</h4>
                                <p class="text-sm text-gray-600">Everything you need for perfect comfort</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 flex items-start space-x-4">
                            <div class="bg-gold-light rounded-full p-3">
                                <svg class="w-6 h-6 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Prime Location</h4>
                                <p class="text-sm text-gray-600">Close to major attractions and business centers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Bar -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 pt-8 border-t border-gold">
                <div class="text-center">
                    <div class="text-4xl font-bold text-gold-dark mb-2">30+</div>
                    <div class="text-gray-600 text-sm uppercase tracking-wide">Luxury Rooms</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-gold-dark mb-2">5★</div>
                    <div class="text-gray-600 text-sm uppercase tracking-wide">Guest Rating</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-gold-dark mb-2">24/7</div>
                    <div class="text-gray-600 text-sm uppercase tracking-wide">Premium Service</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-gold-dark mb-2">100%</div>
                    <div class="text-gray-600 text-sm uppercase tracking-wide">Guest Satisfaction</div>
                </div>
            </div>
        </div>

        <!-- Booking Section -->
        <div class="relative overflow-hidden rounded-2xl shadow-2xl mb-16 scroll-reveal">
            <!-- Background with Overlay -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo e(asset('images/hotel/e8243d1a-3b10-4ce0-8506-d6c6d36f180c.JPG')); ?>');"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-gold-dark to-gold opacity-85"></div>
            
            <!-- Content -->
            <div class="relative z-10 p-8 md:p-16">
                <div class="max-w-4xl mx-auto">
                    <!-- Header -->
                    <div class="text-center mb-10">
                        <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 drop-shadow-lg">Ready to Experience Luxury?</h2>
                        <p class="text-white text-xl opacity-95 drop-shadow">Book your perfect stay at Golden Sky Hotel & Wellness</p>
                    </div>
                    
                    <!-- Booking Form -->
                    <form action="<?php echo e(route('rooms.index')); ?>" method="GET" class="bg-white bg-opacity-95 backdrop-blur-sm rounded-2xl shadow-2xl p-8">
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="flex items-center text-sm font-bold text-gray-800 mb-3 uppercase tracking-wide">
                                    <svg class="w-5 h-5 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Check-in Date
                                </label>
                                <input type="date" id="home_check_in_date" name="check_in" value="<?php echo e(request('check_in')); ?>" 
                                       min="<?php echo e(date('Y-m-d')); ?>" 
                                       class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-lg focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark"
                                       required>
                            </div>
                            <div>
                                <label class="flex items-center text-sm font-bold text-gray-800 mb-3 uppercase tracking-wide">
                                    <svg class="w-5 h-5 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Check-out Date
                                </label>
                                <input type="date" id="home_check_out_date" name="check_out" value="<?php echo e(request('check_out')); ?>" 
                                       min="<?php echo e(request('check_in') ? date('Y-m-d', strtotime(request('check_in') . ' +1 day')) : date('Y-m-d', strtotime('+1 day'))); ?>" 
                                       class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-lg focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark"
                                       required>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="flex items-center text-sm font-bold text-gray-800 mb-3 uppercase tracking-wide">
                                    <svg class="w-5 h-5 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Number of Guests
                                </label>
                                <select name="guests" class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-lg focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                                    <option value="1">1 Guest</option>
                                    <option value="2" selected>2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4+ Guests</option>
                                </select>
                            </div>
                            <div>
                                <label class="flex items-center text-sm font-bold text-gray-800 mb-3 uppercase tracking-wide">
                                    <svg class="w-5 h-5 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Room Type
                                </label>
                                <select name="room_type" class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-lg focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                                    <option value="">All Room Types</option>
                                    <option value="Standard">Standard Room</option>
                                    <option value="Deluxe">Deluxe Room</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Executive">Executive Suite</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-gold-dark to-gold hover:from-gold hover:to-gold-dark text-white font-bold py-5 px-8 rounded-xl transition duration-300 transform hover:scale-105 shadow-2xl text-xl flex items-center justify-center space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>Check Availability & Book Now</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- What Sets Us Apart Section -->
        <div class="mb-20">
            <div class="text-center mb-12 scroll-reveal">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">What Sets Us Apart</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group">
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="h-48 overflow-hidden">
                            <img src="<?php echo e(asset('images/hotel/262e20c6-f346-42e2-81ce-d4c7335eaf99.JPG')); ?>" 
                                 alt="Exceptional Service" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-8 text-center">
                            <div class="bg-gradient-to-br from-gold to-gold-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg transform group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-3">Exceptional Service</h4>
                            <p class="text-gray-600 leading-relaxed">Our dedicated team of hospitality professionals ensures every need is met with warmth, efficiency, and genuine care</p>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group">
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="h-48 overflow-hidden">
                            <img src="<?php echo e(asset('images/hotel/1bcdf224-a866-43f7-8b02-3136ed33eb51.JPG')); ?>" 
                                 alt="Premium Quality" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-8 text-center">
                            <div class="bg-gradient-to-br from-gold to-gold-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg transform group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-3">Premium Quality</h4>
                            <p class="text-gray-600 leading-relaxed">From premium linens to state-of-the-art facilities, we provide only the finest amenities for an exceptional stay</p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group">
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="h-48 overflow-hidden">
                            <img src="<?php echo e(asset('images/hotel/2a20d2d9-a945-4bf8-bc84-2f1804b64039.JPG')); ?>" 
                                 alt="Unforgettable Experience" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-8 text-center">
                            <div class="bg-gradient-to-br from-gold to-gold-dark w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg transform group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-3">Unforgettable Experience</h4>
                            <p class="text-gray-600 leading-relaxed">Create cherished memories that last a lifetime in our luxurious and tranquil setting designed for your comfort</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Reviews Section -->
        <div id="reviews" class="mb-20 bg-white py-16" 
             x-data="reviewCarousel()">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12 scroll-reveal">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Google Reviews</h2>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-1">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <svg class="w-8 h-8 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <span class="text-lg font-semibold text-gray-900"><?php echo e($overallRating); ?> rating of <?php echo e($totalReviews); ?> reviews</span>
                        </div>
                    </div>
                    <a href="https://www.google.com/maps/place/Golden+Sky+Hotel+%26+Wellness" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="mt-4 md:mt-0 inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                        Write a review
                    </a>
                </div>

                <!-- Reviews Carousel -->
                <div class="relative">
                    <!-- Navigation Arrow Left -->
                    <button @click="prev()"
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 transition-all duration-300 border border-gray-200"
                            :class="{ 'opacity-50 cursor-not-allowed': currentIndex === 0 }">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    <!-- Reviews Container -->
                    <div class="overflow-hidden px-12">
                        <div class="flex transition-transform duration-500 ease-in-out" 
                             :style="'transform: translateX(-' + (currentIndex * (100 / 3)) + '%)'">
                            <template x-for="(review, index) in reviews" :key="index">
                                <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-6 h-full">
                                        <!-- Avatar -->
                                        <div class="flex justify-center mb-4">
                                            <div class="w-16 h-16 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                                <span x-text="review.avatar"></span>
                                            </div>
                                        </div>
                                        
                                        <!-- Name -->
                                        <h4 class="text-center font-bold text-gray-900 text-lg mb-1" x-text="review.name"></h4>
                                        
                                        <!-- Date -->
                                        <p class="text-center text-sm text-gray-500 mb-3" x-text="review.date"></p>
                                        
                                        <!-- Stars -->
                                        <div class="flex justify-center items-center space-x-1 mb-4">
                                            <template x-for="i in [1, 2, 3, 4, 5]" :key="i">
                                                <svg class="w-5 h-5" 
                                                     :class="i <= review.rating ? 'text-gold' : 'text-gray-300'" 
                                                     fill="currentColor" 
                                                     viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </template>
                                        </div>
                                        
                                        <!-- Review Text -->
                                        <p class="text-gray-700 text-center leading-relaxed mb-4" x-text="review.text"></p>
                                        
                                        <!-- Google Logo -->
                                        <div class="flex justify-center">
                                            <svg class="w-6 h-6" viewBox="0 0 24 24">
                                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Navigation Arrow Right -->
                    <button @click="next()"
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 transition-all duration-300 border border-gray-200"
                            :class="{ 'opacity-50 cursor-not-allowed': currentIndex >= reviews.length - 3 }">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Dots Indicator -->
                <div class="flex justify-center space-x-2 mt-8">
                    <template x-for="(dot, index) in Math.ceil(reviews.length / 3)" :key="index">
                        <button @click="goTo(index)"
                                class="w-2 h-2 rounded-full transition-all duration-300"
                                :class="index === Math.floor(currentIndex / 3) ? 'bg-gold w-8' : 'bg-gray-300'">
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Rooms & Rates Section -->
        <div class="mb-20" x-data="{ selectedRoom: null }">
            <!-- Section Header -->
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Rooms & Suites</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold to-transparent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Choose from our selection of beautifully appointed accommodations</p>
            </div>

            <!-- Rooms Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $rooms->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="group scroll-reveal scroll-reveal-delay-<?php echo e(($loop->index * 100) + 100); ?>">
                        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <!-- Room Image with Gradient Overlay -->
                            <div class="relative h-56 overflow-hidden">
                                <?php
                                    $roomImages = [
                                        'Standard' => '2dc02e3a-c784-4f6a-8d59-344896bd3dad.JPG',
                                        'Deluxe' => '4da8a997-5601-402c-b778-3c6fad4bb393.JPG',
                                        'Suite' => '541e5305-cd2e-4b01-8fb6-64645a20a696.JPG',
                                        'Executive' => '5a2413b7-94e9-4829-ad4e-a991d8ceb8cc.JPG',
                                    ];
                                    $roomType = $room['roomType'] ?? '';
                                    $imageName = $roomImages[$roomType] ?? '04af6130-85c5-4a18-891d-4842c56f6183.JPG';
                                ?>
                                <img src="<?php echo e(asset('images/hotel/' . $imageName)); ?>" 
                                     alt="<?php echo e($roomType); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <!-- Floating Badge -->
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg transform translate-x-20 group-hover:translate-x-0 transition-transform duration-500">
                                    <span class="text-gold-dark font-bold text-xs"><?php echo e($room['maxOccupancy'] ?? 0); ?> Guests</span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Room Type -->
                                <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-gold-dark transition-colors duration-300">
                                    <?php echo e($roomType); ?>

                                </h3>
                                
                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    Perfect for your comfortable stay with modern amenities and elegant design
                                </p>
                                
                                <!-- Divider -->
                                <div class="w-12 h-0.5 bg-gold mb-4 group-hover:w-full transition-all duration-500"></div>
                                
                                <!-- Price -->
                                <div class="flex items-baseline justify-center mb-5">
                                    <span class="text-2xl font-bold bg-gradient-to-r from-gold-dark to-gold bg-clip-text text-transparent">
                                        LKR <?php echo e(number_format($room['pricePerNight'] ?? 0, 0)); ?>

                                    </span>
                                    <span class="text-gray-500 text-xs ml-2">/ night</span>
                                </div>
                                
                                <!-- Button -->
                                <button @click="selectedRoom = {
                                    id: <?php echo e($room['id'] ?? 0); ?>,
                                    room_number: '<?php echo e($room['roomNumber'] ?? ''); ?>',
                                    room_type: '<?php echo e($roomType); ?>',
                                    price_per_night: <?php echo e($room['pricePerNight'] ?? 0); ?>,
                                    max_occupancy: <?php echo e($room['maxOccupancy'] ?? 0); ?>,
                                    status: '<?php echo e($room['status'] ?? 'AVAILABLE'); ?>',
                                    image: '<?php echo e($imageName); ?>'
                                }"
                                   class="block w-full bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-3 px-5 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-2xl text-center group-hover:shadow-gold/50 cursor-pointer">
                                    <span class="flex items-center justify-center space-x-2 text-sm">
                                        <span>View Details</span>
                                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-3 text-center text-gray-600">No rooms available at the moment.</p>
                <?php endif; ?>
            </div>

            <!-- View All Rooms Link -->
            <div class="text-center mt-12">
                <a href="<?php echo e(route('rooms.index')); ?>" 
                   class="inline-flex items-center space-x-2 text-gold-dark hover:text-gold font-semibold text-lg group">
                    <span>Explore All Our Rooms</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Room Details Modal -->
            <div x-show="selectedRoom" 
                 x-cloak
                 @click.self="selectedRoom = null"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                 style="display: none;">
                <div @click.away="selectedRoom = null"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                    
                    <!-- Close Button -->
                    <button @click="selectedRoom = null" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/90 hover:bg-white rounded-full shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:rotate-90">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Modal Content -->
                    <template x-if="selectedRoom">
                        <div>
                            <!-- Room Image -->
                            <div class="relative h-80 overflow-hidden rounded-t-3xl">
                                <img :src="'/images/hotel/' + selectedRoom.image" 
                                     :alt="selectedRoom.room_type"
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute bottom-6 left-6">
                                    <h2 class="text-4xl font-bold text-white drop-shadow-lg" x-text="selectedRoom.room_type"></h2>
                                    <p class="text-white/90 text-lg">Room <span x-text="selectedRoom.room_number"></span></p>
                                </div>
                                <div class="absolute top-6 right-20 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg">
                                    <span class="text-gold-dark font-bold text-sm" x-text="selectedRoom.max_occupancy + ' Guests'"></span>
                                </div>
                            </div>

                            <!-- Room Details Content -->
                            <div class="p-8">
                                <!-- Price Section -->
                                <div class="bg-gradient-to-r from-gold-light/30 to-gold/20 rounded-2xl p-6 mb-8 border-2 border-gold/20">
                                    <div class="flex items-baseline justify-between">
                                        <div>
                                            <p class="text-sm text-gray-600 mb-1">Price per night</p>
                                            <div class="flex items-baseline">
                                                <span class="text-5xl font-bold bg-gradient-to-r from-gold-dark to-gold bg-clip-text text-transparent" x-text="'LKR ' + parseFloat(selectedRoom.price_per_night).toLocaleString()"></span>
                                                <span class="text-gray-500 text-lg ml-2">/ night</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold" 
                                                  :class="selectedRoom.status === 'AVAILABLE' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                                  x-text="selectedRoom.status"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Room Features Grid -->
                                <div class="grid md:grid-cols-2 gap-6 mb-8">
                                    <!-- Room Information -->
                                    <div class="bg-gray-50 rounded-xl p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <svg class="w-6 h-6 text-gold-dark mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Room Information
                                        </h3>
                                        <ul class="space-y-3">
                                            <li class="flex items-center text-gray-700">
                                                <svg class="w-5 h-5 text-gold-dark mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                <span>Max <span x-text="selectedRoom.max_occupancy"></span> Guests</span>
                                            </li>
                                            <li class="flex items-center text-gray-700">
                                                <svg class="w-5 h-5 text-gold-dark mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <span>Room <span x-text="selectedRoom.room_number"></span></span>
                                            </li>
                                            <li class="flex items-center text-gray-700">
                                                <svg class="w-5 h-5 text-gold-dark mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                                </svg>
                                                <span x-text="selectedRoom.room_type + ' Category'"></span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Amenities -->
                                    <div class="bg-gray-50 rounded-xl p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                            <svg class="w-6 h-6 text-gold-dark mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Amenities
                                        </h3>
                                        <ul class="space-y-2 text-gray-700 text-sm">
                                            <li class="flex items-center">
                                                <span class="w-2 h-2 bg-gold rounded-full mr-3"></span>
                                                Free Wi-Fi
                                            </li>
                                            <li class="flex items-center">
                                                <span class="w-2 h-2 bg-gold rounded-full mr-3"></span>
                                                Air Conditioning
                                            </li>
                                            <li class="flex items-center">
                                                <span class="w-2 h-2 bg-gold rounded-full mr-3"></span>
                                                Smart TV
                                            </li>
                                            <li class="flex items-center">
                                                <span class="w-2 h-2 bg-gold rounded-full mr-3"></span>
                                                Mini Bar
                                            </li>
                                            <li class="flex items-center">
                                                <span class="w-2 h-2 bg-gold rounded-full mr-3"></span>
                                                24/7 Room Service
                                            </li>
                                            <li class="flex items-center">
                                                <span class="w-2 h-2 bg-gold rounded-full mr-3"></span>
                                                Premium Toiletries
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-8">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">About This Room</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Experience luxury and comfort in our meticulously designed <span x-text="selectedRoom.room_type"></span> room. 
                                        Each room features premium furnishings, modern amenities, and elegant decor that creates the perfect sanctuary for your stay. 
                                        Whether you're here for business or leisure, our rooms provide everything you need for an unforgettable experience.
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex space-x-4">
                                    <?php if(auth()->guard()->check()): ?>
                                        <a :href="'/bookings/create?room_id=' + selectedRoom.id"
                                           class="flex-1 bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl text-center flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                            <span>Book This Room</span>
                                        </a>
                                    <?php else: ?>
                                        <a :href="'/login?redirect=/bookings/create?room_id=' + selectedRoom.id"
                                           class="flex-1 bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl text-center flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Login to Book</span>
                                        </a>
                                    <?php endif; ?>
                                    <button @click="selectedRoom = null"
                                            class="flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-8 rounded-xl transition-all duration-300 border-2 border-gray-300">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- What to Explore in Kandy -->
        <div class="mb-20">
            <!-- Section Header -->
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Explore Kandy</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold to-transparent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover the cultural heart of Sri Lanka with its rich heritage and natural beauty</p>
            </div>

            <!-- Tourist Attractions Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Temple of the Sacred Tooth Relic -->
                <a href="https://en.wikipedia.org/wiki/Temple_of_the_Tooth" target="_blank" class="group block scroll-reveal scroll-reveal-delay-100">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer">
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?php echo e(asset('images/kandy/temple-tooth-relic.webp')); ?>" 
                                 alt="Temple of the Sacred Tooth Relic" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-gold/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-white font-bold text-xs">UNESCO Heritage</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-gold-dark transition-colors">Temple of the Tooth</h3>
                            <p class="text-gray-600 text-sm mb-3 leading-relaxed">Sacred Buddhist temple housing the relic of the tooth of Buddha. A UNESCO World Heritage Site and spiritual landmark.</p>
                            <div class="flex items-center text-gold-dark text-sm font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>2.5 km from hotel</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Royal Botanical Gardens -->
                <a href="https://en.wikipedia.org/wiki/Royal_Botanical_Gardens,_Peradeniya" target="_blank" class="group block scroll-reveal scroll-reveal-delay-200">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer">
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?php echo e(asset('images/kandy/botanical-garden.jpg')); ?>" 
                                 alt="Royal Botanical Gardens" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-green-600/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-white font-bold text-xs">Nature & Gardens</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-gold-dark transition-colors">Botanical Gardens</h3>
                            <p class="text-gray-600 text-sm mb-3 leading-relaxed">147-acre paradise in Peradeniya featuring exotic plants, orchids, and scenic landscapes perfect for a peaceful stroll.</p>
                            <div class="flex items-center text-gold-dark text-sm font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>5.5 km from hotel</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Kandy Lake -->
                <a href="https://en.wikipedia.org/wiki/Kandy_Lake" target="_blank" class="group block scroll-reveal scroll-reveal-delay-300">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer">
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?php echo e(asset('images/kandy/kandy-lake.jpg')); ?>" 
                                 alt="Kandy Lake" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-blue-600/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-white font-bold text-xs">Scenic Beauty</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-gold-dark transition-colors">Kandy Lake</h3>
                            <p class="text-gray-600 text-sm mb-3 leading-relaxed">Picturesque artificial lake in the heart of Kandy, perfect for evening walks with stunning mountain views.</p>
                            <div class="flex items-center text-gold-dark text-sm font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>2 km from hotel</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Bahirawakanda Vihara Buddha Statue -->
                <a href="https://en.wikipedia.org/wiki/Bahirawakanda_Vihara_Buddha_Statue" target="_blank" class="group block scroll-reveal scroll-reveal-delay-100">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer">
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?php echo e(asset('images/kandy/buddha-statue.jpg')); ?>" 
                                 alt="Bahirawakanda Buddha Statue" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-purple-600/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-white font-bold text-xs">Panoramic Views</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-gold-dark transition-colors">Buddha Statue</h3>
                            <p class="text-gray-600 text-sm mb-3 leading-relaxed">Giant white Buddha statue at Bahirawakanda offering breathtaking panoramic views of Kandy city and surrounding hills.</p>
                            <div class="flex items-center text-gold-dark text-sm font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>3 km from hotel</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Udawattakele Forest Reserve -->
                <a href="https://en.wikipedia.org/wiki/Udawatta_Kele_Sanctuary" target="_blank" class="group block scroll-reveal scroll-reveal-delay-200">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer">
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?php echo e(asset('images/kandy/udawatta-forest.jpg')); ?>" 
                                 alt="Udawattakele Forest" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-emerald-600/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-white font-bold text-xs">Wildlife Sanctuary</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-gold-dark transition-colors">Forest Reserve</h3>
                            <p class="text-gray-600 text-sm mb-3 leading-relaxed">Historic forest sanctuary with diverse wildlife, nature trails, and serene environment perfect for bird watching.</p>
                            <div class="flex items-center text-gold-dark text-sm font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>1.5 km from hotel</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Ceylon Tea Museum -->
                <a href="https://en.wikipedia.org/wiki/Ceylon_Tea_Museum" target="_blank" class="group block scroll-reveal scroll-reveal-delay-300">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer">
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?php echo e(asset('images/kandy/tea-museum-hanthana.webp')); ?>" 
                                 alt="Ceylon Tea Museum" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-amber-600/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                <span class="text-white font-bold text-xs">Cultural Experience</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-gold-dark transition-colors">Tea Museum</h3>
                            <p class="text-gray-600 text-sm mb-3 leading-relaxed">Learn about Sri Lanka's famous tea industry with exhibits, tastings, and stunning views of tea plantations.</p>
                            <div class="flex items-center text-gold-dark text-sm font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                <span>4 km from hotel</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Helpful Information -->
            <div class="mt-12 bg-gradient-to-r from-gold-light/30 to-white rounded-2xl p-8 border-2 border-gold/20">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Plan Your Kandy Adventure</h4>
                        <p class="text-gray-700 mb-3">Our concierge team can arrange guided tours, transportation, and provide detailed information about all attractions in Kandy.</p>
                        <div class="flex flex-wrap gap-3">
                            <span class="inline-flex items-center bg-white px-4 py-2 rounded-full text-sm font-semibold text-gray-700 shadow">
                                <svg class="w-4 h-4 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Guided Tours Available
                            </span>
                            <span class="inline-flex items-center bg-white px-4 py-2 rounded-full text-sm font-semibold text-gray-700 shadow">
                                <svg class="w-4 h-4 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Transport Arrangements
                            </span>
                            <span class="inline-flex items-center bg-white px-4 py-2 rounded-full text-sm font-semibold text-gray-700 shadow">
                                <svg class="w-4 h-4 mr-2 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                24/7 Concierge Support
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Services Section -->
        <div class="mb-20">
            <!-- Section Header -->
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-5xl md:text-6xl font-bold text-gray-900 mb-4">Discover Our Services</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold to-transparent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Indulge in world-class facilities designed for your ultimate comfort</p>
            </div>

            <!-- Services Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Luxury Rooms -->
                <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 scroll-reveal scroll-reveal-delay-100">
                    <div class="relative h-96">
                        <img src="<?php echo e(asset('images/hotel/2dc02e3a-c784-4f6a-8d59-344896bd3dad.JPG')); ?>" 
                             alt="Luxury Rooms" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <!-- Icon Badge -->
                        <div class="absolute top-6 left-6 w-16 h-16 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white transform group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-3xl font-bold mb-3">Luxury Rooms</h3>
                            <p class="text-white/90 leading-relaxed mb-4">Elegantly designed rooms featuring premium furnishings, modern amenities, and stunning views for the perfect retreat</p>
                            <div class="flex items-center space-x-2 text-gold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                <span class="font-semibold">Explore Rooms</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fine Dining -->
                <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 scroll-reveal scroll-reveal-delay-200">
                    <div class="relative h-96">
                        <img src="<?php echo e(asset('images/hotel/25d6bd5d-1d42-4f67-b177-7821da518a85.JPG')); ?>" 
                             alt="Fine Dining" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <!-- Icon Badge -->
                        <div class="absolute top-6 left-6 w-16 h-16 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white transform group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-3xl font-bold mb-3">Fine Dining</h3>
                            <p class="text-white/90 leading-relaxed mb-4">Experience exquisite cuisine crafted by our master chefs using the finest ingredients and innovative techniques</p>
                            <div class="flex items-center space-x-2 text-gold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                <span class="font-semibold">View Menu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wellness Center -->
                <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 scroll-reveal scroll-reveal-delay-300">
                    <div class="relative h-96">
                        <img src="<?php echo e(asset('images/hotel/2a20d2d9-a945-4bf8-bc84-2f1804b64039.JPG')); ?>" 
                             alt="Wellness Center" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        
                        <!-- Icon Badge -->
                        <div class="absolute top-6 left-6 w-16 h-16 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white transform group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-3xl font-bold mb-3">Wellness & Spa</h3>
                            <p class="text-white/90 leading-relaxed mb-4">Rejuvenate your mind, body, and soul at our state-of-the-art wellness center with premium spa treatments</p>
                            <div class="flex items-center space-x-2 text-gold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                <span class="font-semibold">Learn More</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function reviewCarousel() {
    return {
        currentIndex: 0,
        reviews: <?php echo json_encode($reviews ?? [], 15, 512) ?>,
        
        next() {
            if (this.currentIndex < this.reviews.length - 3) {
                this.currentIndex++;
            } else {
                this.currentIndex = 0;
            }
        },
        
        prev() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            } else {
                this.currentIndex = this.reviews.length - 3;
            }
        },
        
        goTo(index) {
            this.currentIndex = index * 3;
        }
    }
}

// Date validation for booking form
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('home_check_in_date');
    const checkOutInput = document.getElementById('home_check_out_date');
    
    if (checkInInput && checkOutInput) {
        // Update check-out date min when check-in date changes
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            
            if (checkInDate) {
                // Set check-out min to the day after check-in
                const nextDay = new Date(checkInDate);
                nextDay.setDate(nextDay.getDate() + 1);
                
                // Format as YYYY-MM-DD
                const minDate = nextDay.toISOString().split('T')[0];
                checkOutInput.setAttribute('min', minDate);
                
                // If current check-out date is before the new min, update it
                const currentCheckOut = new Date(checkOutInput.value);
                if (checkOutInput.value && currentCheckOut <= checkInDate) {
                    checkOutInput.value = minDate;
                }
            }
        });
        
        // Validate check-out date when it changes
        checkOutInput.addEventListener('change', function() {
            const checkInDate = new Date(checkInInput.value);
            const checkOutDate = new Date(this.value);
            
            if (checkInDate && checkOutDate && checkOutDate <= checkInDate) {
                // Reset to minimum allowed date
                const nextDay = new Date(checkInDate);
                nextDay.setDate(nextDay.getDate() + 1);
                this.value = nextDay.toISOString().split('T')[0];
                
                // Show alert
                alert('Check-out date must be after check-in date. Please select a valid date.');
            }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/duminduthalwatta/Documents/Golden Sky with change /Golden Sky Hotel & Wellness/Golden Sky Hotel & Wellness/Web application/resources/views/home.blade.php ENDPATH**/ ?>