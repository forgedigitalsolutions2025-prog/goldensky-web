@extends('layouts.app')

@section('title', 'Menu - Golden Sky Hotel & Wellness')

@section('content')
<!-- Page Header -->
<div class="relative h-80 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/hotel/25d6bd5d-1d42-4f67-b177-7821da518a85.JPG') }}');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-5xl md:text-6xl font-bold mb-4">Restaurant Menu</h1>
            <p class="text-xl md:text-2xl opacity-90">Discover our exquisite culinary offerings</p>
        </div>
    </div>
</div>

<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @forelse($menuItems as $category => $items)
            <div class="mb-16">
                <!-- Category Header -->
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-gray-900 mb-2">
                        {{ ucwords(str_replace('_', ' ', $category)) }}
                    </h2>
                    <div class="w-24 h-1 bg-gold mx-auto"></div>
                </div>

                <!-- Menu Items Grid -->
                <div class="grid md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-4 gap-y-6">
                    @foreach($items as $item)
                        @php
                            // Handle both object and array formats from API
                            $itemName = is_array($item) ? $item['name'] : $item->name;
                            $itemDescription = is_array($item) ? ($item['description'] ?? null) : ($item->description ?? null);
                            $itemAvailable = is_array($item) ? ($item['available'] ?? true) : ($item->available ?? true);
                            $imagePath = is_array($item) ? ($item['imagePath'] ?? null) : ($item->imagePath ?? $item->image_path ?? null);
                            
                            // Convert Restaurant app image path to web-accessible path
                            // Restaurant app stores: data/menu_images/filename.png
                            // Web app needs: images/menu/filename.png or direct path
                            if ($imagePath) {
                                // Replace data/menu_images/ with images/menu/ for web access
                                $imagePath = str_replace('data/menu_images/', 'images/menu/', $imagePath);
                                // If it's already images/menu/, keep it
                                if (!str_starts_with($imagePath, 'images/') && !str_starts_with($imagePath, 'http')) {
                                    // If it's just a filename, prepend images/menu/
                                    if (!str_contains($imagePath, '/')) {
                                        $imagePath = 'images/menu/' . $imagePath;
                                    }
                                }
                            }
                        @endphp
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 group">
                            <!-- Food Image -->
                            <div class="relative h-40 overflow-hidden bg-gray-100">
                                @if($imagePath)
                                    <img src="{{ asset($imagePath) }}" 
                                         alt="{{ $itemName }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         onerror="this.onerror=null; this.src='{{ asset('images/hotel/25d6bd5d-1d42-4f67-b177-7821da518a85.JPG') }}';">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gold-light to-white">
                                        <svg class="w-12 h-12 text-gold-dark opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Item Details -->
                            <div class="p-3">
                                <!-- Item Name -->
                                <h3 class="text-base font-bold text-gray-900 mb-1">{{ $itemName }}</h3>
                                
                                <!-- Description -->
                                @if($itemDescription)
                                    <p class="text-xs text-gray-600 line-clamp-2">{{ $itemDescription }}</p>
                                @else
                                    <p class="text-xs text-gray-400 italic">Delicious and freshly prepared</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Menu Coming Soon</h3>
                <p class="text-gray-600">Our culinary team is preparing something special for you!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection






