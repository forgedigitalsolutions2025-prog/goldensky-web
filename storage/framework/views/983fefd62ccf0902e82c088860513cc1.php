<?php $__env->startSection('title', 'Book a Room - Golden Sky Hotel & Wellness'); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="relative h-64 bg-cover bg-center bg-no-repeat" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?php echo e(asset('images/hotel/04af6130-85c5-4a18-891d-4842c56f6183.JPG')); ?>');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-5xl font-bold mb-3 drop-shadow-lg">Complete Your Booking</h1>
            <p class="text-xl opacity-90">Just a few steps away from your perfect stay</p>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Room Summary Card -->
        <?php if($room): ?>
            <div class="bg-gradient-to-r from-gold-dark to-gold rounded-2xl shadow-2xl p-8 mb-8 -mt-20 relative z-10">
                <div class="flex items-center justify-between text-white">
                    <div>
                        <h2 class="text-3xl font-bold mb-2"><?php echo e($room->room_type); ?></h2>
                        <p class="text-white/90">Room <?php echo e($room->room_number); ?> • Max <?php echo e($room->max_occupancy); ?> Guests</p>
                    </div>
                    <div class="text-right">
                        <div class="text-4xl font-bold" id="price-display">LKR <?php echo e(number_format($room->price_per_night, 0)); ?></div>
                        <p class="text-white/80" id="package-display">per night</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-10">
            <?php if(auth()->guard()->check()): ?>
                <div class="bg-gradient-to-r from-gold/10 to-gold-light/20 border-l-4 border-gold rounded-xl p-5 mb-8 flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-gold to-gold-dark rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Logged in as</p>
                        <p class="text-base font-bold text-gray-900"><?php echo e(auth()->user()->name); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <form action="<?php echo e(route('bookings.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <!-- Guest Information Section -->
                <div class="mb-10">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-gold to-gold-dark rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Guest Information</h2>
                    </div>
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">First Name *</label>
                        <input type="text" name="first_name" value="<?php echo e(old('first_name', $guest->first_name ?? '')); ?>" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Last Name *</label>
                        <input type="text" name="last_name" value="<?php echo e(old('last_name', $guest->last_name ?? '')); ?>" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Email *</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $guest->email ?? $user->email ?? '')); ?>" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Phone *</label>
                        <input type="text" name="phone" value="<?php echo e(old('phone', $guest->phone ?? '')); ?>" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Nationality</label>
                        <input type="text" name="nationality" value="<?php echo e(old('nationality', $guest->nationality ?? '')); ?>"
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Passport Number</label>
                        <input type="text" name="passport_number" value="<?php echo e(old('passport_number', $guest->passport_number ?? '')); ?>"
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Address</label>
                    <textarea name="address" rows="3"
                              class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark"><?php echo e(old('address', $guest->address ?? '')); ?></textarea>
                </div>

                <!-- Booking Details Section -->
                <div class="mb-10 mt-12">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-gold to-gold-dark rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Booking Details</h2>
                    </div>
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Room Number *</label>
                        <select name="room_number" id="room_number" required
                                class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['room_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">Select a room</option>
                            <?php
                                // Get all rooms and filter by availability for the selected dates
                                $allRooms = \App\Models\Room::orderBy('room_number')->get();
                                $availableRooms = collect();
                                
                                if ($checkIn && $checkOut) {
                                    // Filter rooms by date availability
                                    foreach ($allRooms as $r) {
                                        if ($r->isAvailableForDates($checkIn, $checkOut)) {
                                            $availableRooms->push($r);
                                        }
                                    }
                                } else {
                                    // If no dates selected, show all rooms
                                    $availableRooms = $allRooms;
                                }
                                
                                // If no rooms available after filtering, show all rooms anyway
                                if ($availableRooms->isEmpty()) {
                                    $availableRooms = $allRooms;
                                }
                            ?>
                            <?php $__currentLoopData = $availableRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($r->room_number); ?>" 
                                        data-room-only="<?php echo e($r->price_room_only ?? $r->price_per_night); ?>"
                                        data-bed-breakfast="<?php echo e($r->price_bed_breakfast ?? $r->price_per_night); ?>"
                                        data-half-board="<?php echo e($r->price_half_board ?? $r->price_per_night); ?>"
                                        data-full-board="<?php echo e($r->price_full_board ?? $r->price_per_night); ?>"
                                        <?php echo e((old('room_number') == $r->room_number || ($room && $room->room_number == $r->room_number)) ? 'selected' : ''); ?>>
                                    <?php echo e($r->room_number); ?> - <?php echo e($r->room_type); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['room_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Package Type *</label>
                        <select name="package_type" id="package_type" required
                                class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['package_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="ROOM_ONLY" <?php echo e(old('package_type', 'ROOM_ONLY') == 'ROOM_ONLY' ? 'selected' : ''); ?>>Room Only</option>
                            <option value="BED_AND_BREAKFAST" <?php echo e(old('package_type') == 'BED_AND_BREAKFAST' ? 'selected' : ''); ?>>Bed & Breakfast</option>
                            <option value="HALF_BOARD" <?php echo e(old('package_type') == 'HALF_BOARD' ? 'selected' : ''); ?>>Half Board</option>
                            <option value="FULL_BOARD" <?php echo e(old('package_type') == 'FULL_BOARD' ? 'selected' : ''); ?>>Full Board</option>
                        </select>
                        <?php $__errorArgs = ['package_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Number of Adults *</label>
                        <input type="number" name="number_of_adults" value="<?php echo e(old('number_of_adults', 1)); ?>" min="1" max="<?php echo e($room ? $room->max_occupancy : 4); ?>" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['number_of_adults'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php if($room): ?>
                            <p class="text-xs text-gray-500 mt-1">Max occupancy for this room: <?php echo e($room->max_occupancy); ?> guests</p>
                        <?php endif; ?>
                        <?php $__errorArgs = ['number_of_adults'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <!-- Empty div to maintain grid layout -->
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Check In *</label>
                        <input type="date" id="booking_check_in_date" name="check_in_time" value="<?php echo e(old('check_in_time', $checkIn)); ?>" 
                               min="<?php echo e(date('Y-m-d')); ?>" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['check_in_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['check_in_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Check Out *</label>
                        <input type="date" id="booking_check_out_date" name="check_out_time" value="<?php echo e(old('check_out_time', $checkOut)); ?>" 
                               min="<?php echo e($checkIn ? date('Y-m-d', strtotime($checkIn . ' +1 day')) : date('Y-m-d', strtotime('+1 day'))); ?>" required
                               class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['check_out_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['check_out_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Number of Children</label>
                    <input type="number" name="number_of_children" value="<?php echo e(old('number_of_children', 0)); ?>" min="0" max="<?php echo e($room ? $room->max_occupancy - 1 : 3); ?>"
                           class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark">
                    <?php if($room): ?>
                        <p class="text-xs text-gray-500 mt-1">Total guests (adults + children) must not exceed <?php echo e($room->max_occupancy); ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Special Requests / Notes</label>
                    <textarea name="notes" rows="4"
                              class="w-full border-2 border-gray-300 rounded-xl px-5 py-3 text-base focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark"
                              placeholder="Any special requests or preferences..."><?php echo e(old('notes')); ?></textarea>
                </div>
                </div>

                <!-- Trust Indicator -->
                <div class="mt-8 mb-6 bg-gradient-to-r from-gold-light/20 to-gold/20 rounded-xl p-6 border-2 border-gold/30">
                    <div class="flex items-center justify-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <div class="flex items-center space-x-1">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                    <svg class="w-5 h-5 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900"><?php echo e(config('reviews.overall_rating', 4.9)); ?> rating</div>
                                <div class="text-sm text-gray-600"><?php echo e(config('reviews.total_reviews', 45)); ?> verified reviews</div>
                            </div>
                        </div>
                        <div class="h-12 w-px bg-gray-300"></div>
                        <div class="flex items-center space-x-2 text-gray-700">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-sm font-semibold">Secure Booking</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4 mt-10 pt-8 border-t border-gray-200">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl flex items-center justify-center space-x-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Confirm Booking</span>
                    </button>
                    <a href="<?php echo e(route('rooms.index')); ?>" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-8 rounded-xl transition-all duration-300 text-center flex items-center justify-center space-x-2 border-2 border-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Back to Rooms</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('booking_check_in_date');
        const checkOutInput = document.getElementById('booking_check_out_date');
        
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

    // Package type and room selection price update
    const roomSelect = document.getElementById('room_number');
    const packageSelect = document.getElementById('package_type');
    const priceDisplay = document.getElementById('price-display');
    const packageDisplay = document.getElementById('package-display');

    // Store room data if pre-selected
    <?php if($room): ?>
    const preselectedRoom = {
        roomNumber: '<?php echo e($room->room_number); ?>',
        roomOnly: <?php echo e($room->price_room_only ?? $room->price_per_night ?? 0); ?>,
        bedBreakfast: <?php echo e($room->price_bed_breakfast ?? $room->price_per_night ?? 0); ?>,
        halfBoard: <?php echo e($room->price_half_board ?? $room->price_per_night ?? 0); ?>,
        fullBoard: <?php echo e($room->price_full_board ?? $room->price_per_night ?? 0); ?>

    };
    <?php else: ?>
    const preselectedRoom = null;
    <?php endif; ?>

    function updatePrice() {
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const selectedPackage = packageSelect.value;

        if (!selectedRoom || !selectedRoom.value) {
            return;
        }

        let price = 0;
        let packageName = '';

        // Use preselected room data if available and room matches
        if (preselectedRoom && selectedRoom.value === preselectedRoom.roomNumber) {
            switch(selectedPackage) {
                case 'ROOM_ONLY':
                    price = preselectedRoom.roomOnly;
                    packageName = 'Room Only';
                    break;
                case 'BED_AND_BREAKFAST':
                    price = preselectedRoom.bedBreakfast;
                    packageName = 'Bed & Breakfast';
                    break;
                case 'HALF_BOARD':
                    price = preselectedRoom.halfBoard;
                    packageName = 'Half Board';
                    break;
                case 'FULL_BOARD':
                    price = preselectedRoom.fullBoard;
                    packageName = 'Full Board';
                    break;
            }
        } else {
            // Use data attributes from select option
            switch(selectedPackage) {
                case 'ROOM_ONLY':
                    price = parseFloat(selectedRoom.dataset.roomOnly || 0);
                    packageName = 'Room Only';
                    break;
                case 'BED_AND_BREAKFAST':
                    price = parseFloat(selectedRoom.dataset.bedBreakfast || 0);
                    packageName = 'Bed & Breakfast';
                    break;
                case 'HALF_BOARD':
                    price = parseFloat(selectedRoom.dataset.halfBoard || 0);
                    packageName = 'Half Board';
                    break;
                case 'FULL_BOARD':
                    price = parseFloat(selectedRoom.dataset.fullBoard || 0);
                    packageName = 'Full Board';
                    break;
            }
        }

        if (price > 0) {
            priceDisplay.textContent = 'LKR ' + price.toLocaleString('en-US', {maximumFractionDigits: 0});
            packageDisplay.textContent = packageName + ' • per night';
        }
    }

    roomSelect.addEventListener('change', updatePrice);
    packageSelect.addEventListener('change', updatePrice);

    // Initialize price on page load
    if ((roomSelect.value && packageSelect.value) || preselectedRoom) {
        updatePrice();
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/resources/views/bookings/create.blade.php ENDPATH**/ ?>