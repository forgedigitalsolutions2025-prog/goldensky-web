<?php $__env->startSection('title', 'Our Ayurvedic Treatments - Shadhara Wellness'); ?>

<?php $__env->startSection('content'); ?>
<section class="page-header">
    <div class="container">
        <h1>Our Ayurvedic Treatments</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo e(route('spa.home')); ?>" itemprop="item">
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
            <?php $__currentLoopData = $treatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="treatment-card">
                <div class="treatment-image">
                    <img src="<?php echo e(asset('spa-assets/images/treatments/' . $treatment->image)); ?>" alt="<?php echo e($treatment->name); ?>" loading="lazy" onerror="this.onerror=null; this.src='<?php echo e(asset('spa-assets/images/treatments/treatments.jpg')); ?>';">
                </div>
                <div class="treatment-content">
                    <h3><?php echo e($treatment->name); ?></h3>
                    <p><?php echo e($treatment->description); ?></p>
                    <?php if($treatment->duration): ?>
                    <div class="treatment-meta">
                        <span class="duration">Duration: <?php echo e($treatment->duration); ?> minutes</span>
                    </div>
                    <?php endif; ?>
                    <div class="treatment-price">
                        <span class="price">$ <?php echo e(number_format($treatment->price, 2)); ?></span>
                    </div>
                    <a href="<?php echo e(route('spa.pricing')); ?>" class="btn-primary">Book Now</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('spa::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/sharadha wellness/resources/views/treatments.blade.php ENDPATH**/ ?>