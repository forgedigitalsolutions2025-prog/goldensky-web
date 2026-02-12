<?php $__env->startSection('title', 'Contact Us - Shadhara Wellness'); ?>

<?php $__env->startSection('content'); ?>
<section class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?php echo e(route('spa.home')); ?>" itemprop="item">
                        <span itemprop="name">Home</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li class="active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">Contact Us</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="contact-page">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-info">
                <h2>Get In Touch</h2>
                <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <h4>Phone Number</h4>
                        <a href="tel:+94714831035">+94 71 483 1035</a>
                    </div>
                    <div class="contact-item">
                        <h4>Email Address</h4>
                        <a href="mailto:reservations@goldenskyhotelandwellness.com">reservations@goldenskyhotelandwellness.com</a>
                    </div>
                    <div class="contact-item">
                        <h4>Office Location</h4>
                        <p>53/1, Hanthana housing scheme, Kandy</p>
                    </div>
                    <div class="contact-item">
                        <h4>Business Hours</h4>
                        <p>Mon - Sat: 08.00 am to 5.00 pm</p>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <h2>Send Us a Message</h2>
                <form action="<?php echo e(route('spa.contact.store')); ?>" method="POST" class="contact-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" value="<?php echo e(old('name')); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" value="<?php echo e(old('email')); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="Your Phone" value="<?php echo e(old('phone')); ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="Subject" value="<?php echo e(old('subject')); ?>">
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message" rows="6" required><?php echo e(old('message')); ?></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>

                <div class="booking-section">
                    <h3>Make An Appointment</h3>
                    <form action="<?php echo e(route('spa.booking.store')); ?>" method="POST" class="booking-form">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <select name="treatment_id" class="form-control" required>
                                <option value="">Select Treatment</option>
                                <?php $__currentLoopData = \App\Models\Treatment::where('is_active', true)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($treatment->id); ?>"><?php echo e($treatment->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="Your Phone" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="date" name="booking_date" min="<?php echo e(date('Y-m-d')); ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="time" name="booking_time" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_couple_package" value="1">
                                Couple Package
                            </label>
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Additional Message (Optional)" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Book Appointment (20% OFF)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <div class="section-header fade-in-up">
            <div class="title-shape"></div>
            <h2>Find Us</h2>
            <p>Visit us at our location in Kandy</p>
        </div>
        <div class="map-wrapper fade-in">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d80.6234!3d7.2901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae368a77d5cbf91%3A0xba828c0e851bceb1!2sHanthana%20Housing%20Scheme%2C%20Kandy!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk&q=Hanthana+housing+scheme+Kandy" 
                width="100%" 
                height="450" 
                style="border:0; border-radius: 10px;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="Shadhara Wellness Location - 53/1, Hanthana housing scheme, Kandy">
            </iframe>
            <div class="map-overlay">
                <div class="map-info-card">
                    <h3>Shadhara Wellness</h3>
                    <p><strong>Address:</strong> 53/1, Hanthana housing scheme, Kandy</p>
                    <p><strong>Phone:</strong> <a href="tel:+94714831035">+94 71 483 1035</a></p>
                    <p><strong>Email:</strong> <a href="mailto:reservations@goldenskyhotelandwellness.com">reservations@goldenskyhotelandwellness.com</a></p>
                    <a href="https://www.google.com/maps/search/?api=1&query=Hanthana+housing+scheme,+Kandy" target="_blank" class="btn-primary" style="margin-top: 1rem; display: inline-block;">Get Directions</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('spa::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/duminduthalwatta/Documents/Forge Software Solutions/Golden Sky Hotel & Wellness/Web application/sharadha wellness/resources/views/contact.blade.php ENDPATH**/ ?>