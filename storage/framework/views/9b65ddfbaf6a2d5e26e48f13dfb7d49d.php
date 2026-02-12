<?php $__env->startSection('title', 'Pricing Plan - Shadhara Wellness'); ?>

<?php $__env->startSection('content'); ?>
<section class="page-header">
    <div class="container">
        <h1>Pricing Plan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo e(route('spa.home')); ?>" itemprop="item">
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
            <?php $__currentLoopData = $treatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="pricing-card-full">
                <div class="pricing-image">
                    <img src="<?php echo e(asset('spa-assets/images/treatments/' . $treatment->image)); ?>" alt="<?php echo e($treatment->name); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo e(asset('spa-assets/images/treatments/treatments.jpg')); ?>';">
                </div>
                <div class="pricing-content">
                    <h3><?php echo e($treatment->name); ?></h3>
                    <p><?php echo e($treatment->description); ?></p>
                    <?php if($treatment->duration): ?>
                    <div class="pricing-meta">
                        <span>Duration: <?php echo e($treatment->duration); ?> minutes</span>
                    </div>
                    <?php endif; ?>
                    <div class="pricing-price">
                        <span class="price">$ <?php echo e(number_format($treatment->price, 2)); ?></span>
                        <span class="discount">20% OFF</span>
                    </div>
                    <a href="<?php echo e(route('spa.contact')); ?>" class="btn-primary">Book Now</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="discount-banner">
            <h2>Relax Anytime Any Day At 20% Discount</h2>
            <p>Book your appointment today and enjoy our special discount offer</p>
            <a href="<?php echo e(route('spa.contact')); ?>" class="btn-primary">Make An Appointment</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('spa::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/sharadha wellness/resources/views/pricing.blade.php ENDPATH**/ ?>