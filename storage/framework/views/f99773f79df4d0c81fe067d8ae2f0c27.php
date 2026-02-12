<?php $__env->startSection('title', 'Register - Golden Sky Hotel & Wellness'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Background -->
<div class="relative min-h-screen flex items-center justify-center overflow-hidden py-12">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center animate-slow-zoom" 
         style="background-image: url('<?php echo e(asset('images/hotel/770bc666-39a7-444c-b029-18bc1a37b2bb.JPG')); ?>');"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-gold-dark/80 via-black/50 to-gold-dark/80"></div>
    
    <!-- Animated Glow -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/4 right-1/3 w-96 h-96 bg-gold rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 left-1/3 w-96 h-96 bg-gold-light rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>
    </div>
    
    <!-- Register Card -->
    <div class="relative z-10 max-w-sm w-full mx-4 animate-fade-in-up">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-gold to-gold-dark rounded-full mb-3 shadow-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-gold-dark to-gold bg-clip-text text-transparent mb-2">Join Golden Sky</h1>
                <p class="text-sm text-gray-600">Create your account to start booking</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>

                <!-- Full Name -->
                <div>
                    <label class="flex items-center text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                        <svg class="w-4 h-4 mr-1.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Full Name
                    </label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus
                           class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="John Doe">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div>
                    <label class="flex items-center text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                        <svg class="w-4 h-4 mr-1.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email Address
                    </label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                           class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="your.email@example.com">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password -->
                <div>
                    <label class="flex items-center text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                        <svg class="w-4 h-4 mr-1.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Password
                    </label>
                    <input type="password" name="password" required
                           class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Create a strong password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="flex items-center text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                        <svg class="w-4 h-4 mr-1.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" required
                           class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold focus:border-gold transition hover:border-gold-dark"
                           placeholder="Re-enter your password">
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-gold to-gold-dark hover:from-gold-dark hover:to-gold text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl flex items-center justify-center space-x-2 mt-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span>Create Account</span>
                </button>
            </form>

            <?php if(config('services.google.client_id') && config('services.google.client_secret')): ?>
            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-3 bg-white text-gray-500 font-semibold">Or continue with</span>
                </div>
            </div>

            <!-- Google Sign-In Button -->
            <a href="<?php echo e(route('auth.google')); ?>" class="w-full flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-6 rounded-xl border-2 border-gray-300 hover:border-gray-400 transition-all duration-300 transform hover:scale-105 shadow-lg text-sm">
                <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                <span>Sign up with Google</span>
            </a>
            <?php endif; ?>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="<?php echo e(route('login')); ?>" class="text-gold-dark hover:text-gold font-bold underline decoration-2 underline-offset-2 hover:decoration-gold transition">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slow-zoom {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out;
    }
    
    .animate-slow-zoom {
        animation: slow-zoom 20s ease-in-out infinite alternate;
    }
</style>
<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/resources/views/auth/register.blade.php ENDPATH**/ ?>