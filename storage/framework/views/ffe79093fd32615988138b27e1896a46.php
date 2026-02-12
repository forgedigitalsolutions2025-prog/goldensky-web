<?php $__env->startSection('title', 'Shadhara Wellness - Embracing Ancient Ceylon Healing'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Sections -->
<section class="hero-slider">
    <div class="hero-slide active">
        <div class="hero-bg" style="background-image: url('<?php echo e(asset('spa-assets/images/hero/hero-1.png')); ?>');"></div>
        <div class="hero-content">
            <div class="container">
                <h1>Shadhara Wellness Begins with Nature's Touch and Care</h1>
                <a href="<?php echo e(route('spa.treatments')); ?>" class="btn-primary">Our Treatments</a>
            </div>
        </div>
    </div>
    <div class="hero-slide">
        <div class="hero-bg" style="background-image: url('<?php echo e(asset('spa-assets/images/hero/hero-2.png')); ?>');"></div>
        <div class="hero-content">
            <div class="container">
                <h1>Discover Inner Peace Through Herbal Spa and Wellness Rituals</h1>
                <a href="<?php echo e(route('spa.pricing')); ?>" class="btn-primary">Se price plans</a>
            </div>
        </div>
    </div>
    <div class="hero-slide">
        <div class="hero-bg" style="background-image: url('<?php echo e(asset('spa-assets/images/hero/hero-1.png')); ?>');"></div>
        <div class="hero-content">
            <div class="container">
                <h1>Rejuvenate Naturally with Our Herbal Spa Healing Treatments</h1>
                <a href="<?php echo e(route('spa.contact')); ?>" class="btn-primary">Contact Us</a>
            </div>
        </div>
    </div>
    <div class="hero-controls">
        <button class="prev-slide">‹</button>
        <button class="next-slide">›</button>
    </div>
    <div class="hero-dots">
        <span class="dot active" data-slide="0"></span>
        <span class="dot" data-slide="1"></span>
        <span class="dot" data-slide="2"></span>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="section-header fade-in-up">
            <p class="section-subtitle">Ceylon Herbal Spa Healing Rituals</p>
            <div class="title-shape"></div>
            <h2>Traditional Spa and Beauty Service</h2>
        </div>
        <div class="services-grid">
            <?php $__currentLoopData = $treatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="service-card">
                <div class="service-image">
                    <img src="<?php echo e(asset('spa-assets/images/treatments/' . $treatment->image)); ?>" 
                         alt="<?php echo e($treatment->name); ?>" 
                         loading="lazy"
                         onerror="this.onerror=null; this.src='<?php echo e(asset('spa-assets/images/treatments/treatments.jpg')); ?>';">
                </div>
                <div class="service-content">
                    <h3><?php echo e($treatment->name); ?></h3>
                    <p><?php echo e($treatment->description); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-preview">
    <div class="container">
        <div class="about-content">
            <div class="about-text fade-in-left">
                <div class="section-header">
                    <h2>Healing Rooted in Ceylonese Ayurvedic</h2>
                </div>
                <p>At Shadhara Wellnesss, your healing journey begins the moment you arrive. We provide dedicated care with personalized attention from our residential doctor and offer complimentary guided tours, thoughtfully tailored to your treatment package.</p>
                <div class="features-grid">
                    <div class="feature-item">
                        <h4>Traditional Wellness</h4>
                    </div>
                    <div class="feature-item">
                        <h4>Expert Ayu. Doctors</h4>
                        <p>Rooted in generations of traditional healing, Shadhara Wellness follows time-tested Ceylon Ayurveda practices passed down through ancient lineages.</p>
                    </div>
                </div>
                <a href="<?php echo e(route('spa.treatments')); ?>" class="btn-primary">See Our Treatements</a>
            </div>
            <div class="about-stats fade-in-right">
                <div class="stat-item scale-in" data-count="15" data-suffix="+">
                    <h3 class="stat-number">0+</h3>
                    <p>Ayurvedic Doctors</p>
                </div>
                <div class="stat-item scale-in stat-highlight" data-count="100" data-suffix="%">
                    <h3 class="stat-number">0%</h3>
                    <p>Ayurvedic Process</p>
                </div>
                <div class="stat-item scale-in" data-count="500" data-suffix="+">
                    <h3 class="stat-number">0+</h3>
                    <p>Satisfied Clients</p>
                </div>
                <div class="stat-item scale-in" data-count="20" data-suffix="+">
                    <h3 class="stat-number">0+</h3>
                    <p>Specialists Team</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-section">
    <div class="container">
        <div class="section-header fade-in-up">
            <div class="title-shape"></div>
            <h2>Explore Our Wellness Packages for Natural Beauty</h2>
        </div>
        <div class="wellness-content fade-in">
            <h3>Ayurvedic Treatments for Natural Beauty</h3>
            <p>Ayurvedic beauty rituals using herbs, oils, and ancient techniques that purify, nourish, and rejuvenate your skin, hair, and body from within.</p>
            <p>Experience timeless beauty through Ayurveda herbal facials, oil therapies, and detoxifying treatments that enhance radiance, balance skin tone, and restore youthful energy the natural and holistic way.</p>
            <a href="<?php echo e(route('spa.pricing')); ?>" class="btn-primary">Book now</a>
        </div>
        <div class="pricing-preview">
            <div class="pricing-card">
                <div class="pricing-card-header">
                    <h4>Facial Massage</h4>
                </div>
                <div class="pricing-card-body">
                    <p>Boosts glow, tones skin, improves circulation, relaxes facial muscles.</p>
                </div>
                <div class="pricing-card-footer">
                    <p class="price">$30.00</p>
                    <a href="<?php echo e(route('spa.pricing')); ?>" class="btn-secondary">Book Now</a>
                </div>
            </div>
            <div class="pricing-card">
                <div class="pricing-card-header">
                    <h4>Head, Neck and Shoulder Massage</h4>
                </div>
                <div class="pricing-card-body">
                    <p>Relieves tension, improves posture, soothes mind, boosts circulation.</p>
                </div>
                <div class="pricing-card-footer">
                    <p class="price">$35.00</p>
                    <a href="<?php echo e(route('spa.pricing')); ?>" class="btn-secondary">Book Now</a>
                </div>
            </div>
            <div class="pricing-card">
                <div class="pricing-card-header">
                    <h4>Full Body Massage</h4>
                </div>
                <div class="pricing-card-body">
                    <p>Detoxifies, smooths skin, tones muscles, deeply relaxes body.</p>
                </div>
                <div class="pricing-card-footer">
                    <p class="price">$25.00</p>
                    <a href="<?php echo e(route('spa.pricing')); ?>" class="btn-secondary">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Couple Packages Section -->
<section class="couple-packages">
    <div class="container">
        <h2>Individual and Couple Packages for Wellness</h2>
        <p>Discover tailored Ayurvedic experiences designed for individuals and couples, combining ancient therapies, natural beauty rituals, and personalized care to restore balance, intimacy, and inner harmony.</p>
        <div class="package-features">
            <div class="package-feature">
                <div class="feature-icon">
                    <img src="<?php echo e(asset('spa-assets/images/decorations/flower-decoration.png')); ?>" alt="Icon" onerror="this.style.display='none'">
                </div>
                <h3>Personalized Healing Experience</h3>
                <p>Receive treatments uniquely crafted for your body type, health needs, and wellness goals.</p>
            </div>
            <div class="package-feature">
                <div class="feature-icon">
                    <img src="<?php echo e(asset('spa-assets/images/decorations/flower-16.png')); ?>" alt="Icon" onerror="this.style.display='none'">
                </div>
                <h3>Strengthened Bond for Couples</h3>
                <p>Enjoy synchronized therapies that deepen connection, shared relaxation, and emotional well-being together</p>
            </div>
            <div class="package-feature">
                <div class="feature-icon">
                    <img src="<?php echo e(asset('spa-assets/images/decorations/flower-4.svg')); ?>" alt="Icon" onerror="this.style.display='none'">
                </div>
                <h3>Full-Body Rejuvenation</h3>
                <p>Detoxify, relax, and revitalize your entire body through ancient, holistic Ayurvedic rituals.</p>
            </div>
        </div>
    </div>
</section>

<!-- Appointment Section -->
<section class="appointment-section">
    <div class="container">
        <div class="appointment-content">
            <h2>Relax Anytime Any Day At 20% Discount</h2>
            <form action="<?php echo e(route('spa.booking.store')); ?>" method="POST" class="booking-form">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="treatment_id">Select Treatment <span class="required">*</span></label>
                    <select name="treatment_id" id="treatment_id" class="form-control" required>
                        <option value="">Choose a treatment...</option>
                        <?php $__currentLoopData = $treatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($treatment->id); ?>"><?php echo e($treatment->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="treatment-tabs">
                    <?php $__currentLoopData = $treatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="treatment-tab" data-treatment="<?php echo e($treatment->id); ?>"><?php echo e($treatment->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" name="email" id="email" placeholder="your.email@example.com" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" name="phone" id="phone" placeholder="+94 XX XXX XXXX" required>
                    </div>
                    <div class="form-group">
                        <label for="booking_date">Preferred Date <span class="required">*</span></label>
                        <input type="date" name="booking_date" id="booking_date" min="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="booking_time">Preferred Time <span class="required">*</span></label>
                    <input type="time" name="booking_time" id="booking_time" step="900" min="09:00" max="18:00" required>
                    <small class="form-hint">Available hours: 9:00 AM - 6:00 PM</small>
                </div>
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_couple_package" value="1">
                        <span>Couple Package</span>
                    </label>
                </div>
                <div class="form-group">
                    <label for="message">Additional Message</label>
                    <textarea name="message" id="message" placeholder="Any special requests or notes (optional)" rows="4"></textarea>
                </div>
                <button type="submit" class="btn-primary">Make An Appointment</button>
            </form>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header fade-in-up">
            <div class="title-shape"></div>
            <h2>Our Customer Feedbacks</h2>
        </div>
        <div class="testimonials-slider">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="testimonial-card">
                <div class="testimonial-image">
                    <img src="<?php echo e(asset('spa-assets/images/testimonials/' . $testimonial->image)); ?>" alt="<?php echo e($testimonial->name); ?>" onerror="this.src='<?php echo e(asset('spa-assets/images/testimonials/testimonial-1.jpg')); ?>'">
                </div>
                <div class="testimonial-content">
                    <p>"<?php echo e($testimonial->testimonial); ?>"</p>
                    <h4><?php echo e($testimonial->name); ?></h4>
                    <span>Customer <?php echo e($testimonial->location ? 'from ' . $testimonial->location : ''); ?></span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Extra Activities Section -->
<section class="extra-activities">
    <div class="container">
        <div class="section-header fade-in-up">
            <div class="title-shape"></div>
            <h2>Enriching Experiences Beyond Wellness Treatments</h2>
        </div>
        <div class="activities-grid">
            <div class="activity-item">
                <h4>Free Traditional Cooking Classes – 1 Day</h4>
                <p>Learn to prepare authentic Ceylon Ayurvedic meals</p>
                <div class="activity-number">01</div>
            </div>
            <div class="activity-item">
                <h4>Yoga Classes</h4>
                <p>Balance body and mind through guided movements.</p>
                <div class="activity-number">02</div>
            </div>
            <div class="activity-item">
                <h4>Udarata Dancing Class – 1 Hour</h4>
                <p>Experience joyful movement with cultural rhythm expression.</p>
                <div class="activity-number">03</div>
            </div>
            <div class="activity-item">
                <h4>Traditional Weaving</h4>
                <p>Create handmade art with ancestral weaving techniques.</p>
                <div class="activity-number">04</div>
            </div>
            <div class="activity-item">
                <h4>Marathodi Painting</h4>
                <p>Discover heritage through detailed folk-style painting.</p>
                <div class="activity-number">05</div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('spa::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/sharadha wellness/resources/views/home.blade.php ENDPATH**/ ?>