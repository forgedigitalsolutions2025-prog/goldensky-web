// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    if (hamburger) {
        hamburger.addEventListener('click', function() {
            const isActive = navMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
            hamburger.setAttribute('aria-expanded', isActive);
        });
    }

    // Hero Slider with Professional Animations
    const heroSlides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.prev-slide');
    const nextBtn = document.querySelector('.next-slide');
    let currentSlide = 0;
    let isTransitioning = false;
    let autoSlideInterval;

    function showSlide(index, direction = 'next') {
        if (isTransitioning || !heroSlides[index]) return;
        
        isTransitioning = true;
        
        // Remove all classes
        heroSlides.forEach(slide => {
            slide.classList.remove('active', 'prev', 'next');
        });
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Set previous slide
        const prevIndex = direction === 'next' 
            ? (index - 1 + heroSlides.length) % heroSlides.length
            : (index + 1) % heroSlides.length;
        
        if (heroSlides[prevIndex]) {
            heroSlides[prevIndex].classList.add(direction === 'next' ? 'prev' : 'next');
        }
        
        // Set active slide
        heroSlides[index].classList.add('active');
        if (dots[index]) {
            dots[index].classList.add('active');
        }
        
        // Reset content animations
        const activeContent = heroSlides[index].querySelector('.hero-content');
        if (activeContent) {
            const h1 = activeContent.querySelector('h1');
            const btn = activeContent.querySelector('.btn-primary');
            if (h1) {
                h1.style.opacity = '0';
                h1.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    h1.style.opacity = '1';
                    h1.style.transform = 'translateY(0)';
                }, 300);
            }
            if (btn) {
                btn.style.opacity = '0';
                btn.style.transform = 'translateY(30px) scale(0.9)';
                setTimeout(() => {
                    btn.style.opacity = '1';
                    btn.style.transform = 'translateY(0) scale(1)';
                }, 600);
            }
        }
        
        setTimeout(() => {
            isTransitioning = false;
        }, 800);
    }

    function nextSlide() {
        if (isTransitioning) return;
        currentSlide = (currentSlide + 1) % heroSlides.length;
        showSlide(currentSlide, 'next');
        resetAutoSlide();
    }

    function prevSlide() {
        if (isTransitioning) return;
        currentSlide = (currentSlide - 1 + heroSlides.length) % heroSlides.length;
        showSlide(currentSlide, 'prev');
        resetAutoSlide();
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(nextSlide, 6000);
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', prevSlide);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', nextSlide);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            if (isTransitioning) return;
            const direction = index > currentSlide ? 'next' : 'prev';
            currentSlide = index;
            showSlide(currentSlide, direction);
            resetAutoSlide();
        });
    });

    // Initialize first slide
    if (heroSlides.length > 0) {
        showSlide(0, 'next');
        // Auto-slide hero
        autoSlideInterval = setInterval(nextSlide, 6000);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Form validation enhancement
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '#ddd';
                }
            });

            // Email validation
            const emailFields = form.querySelectorAll('input[type="email"]');
            emailFields.forEach(field => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (field.value && !emailRegex.test(field.value)) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                }
            });
        });
    });

    // Auto-hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });

    // Testimonials slider (if needed)
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    if (testimonialCards.length > 0) {
        let testimonialIndex = 0;
        setInterval(() => {
            testimonialCards.forEach(card => card.style.opacity = '0.5');
            testimonialCards[testimonialIndex].style.opacity = '1';
            testimonialIndex = (testimonialIndex + 1) % testimonialCards.length;
        }, 3000);
    }
});

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const navMenu = document.querySelector('.nav-menu');
    const hamburger = document.querySelector('.hamburger');
    
    if (navMenu && hamburger && 
        !navMenu.contains(event.target) && 
        !hamburger.contains(event.target) &&
        navMenu.classList.contains('active')) {
        navMenu.classList.remove('active');
        hamburger.classList.remove('active');
    }
});

// Scroll-triggered animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animated');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all elements with animation classes
document.addEventListener('DOMContentLoaded', function() {
    // Observe fade-in elements
    document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right, .fade-in, .scale-in, .rotate-in').forEach(el => {
        observer.observe(el);
    });

    // Observe grid items with stagger
    const gridItems = document.querySelectorAll('.service-card, .treatment-card, .pricing-card, .testimonial-card, .activity-item');
    gridItems.forEach((item, index) => {
        item.style.transitionDelay = `${index * 0.1}s`;
        observer.observe(item);
    });

    // Observe sections
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });
});

// Header scroll effect
let lastScroll = 0;
const header = document.querySelector('.header');

window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
    
    lastScroll = currentScroll;
});

// Parallax effect for hero background
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const heroBg = document.querySelector('.hero-bg');
    
    if (heroBg) {
        const rate = scrolled * 0.5;
        heroBg.style.transform = `translateY(${rate}px) scale(1.05)`;
    }
});

// Smooth number counter animation
function animateCounter(element, target, suffix = '', duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    const easing = (t) => t * (2 - t); // Ease-out quadratic
    
    const startTime = Date.now();
    
    const timer = setInterval(() => {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = easing(progress);
        const current = Math.floor(target * eased);
        
        element.textContent = current + suffix;
        
        if (progress >= 1) {
            element.textContent = target + suffix;
            clearInterval(timer);
        }
    }, 16);
}

// Initialize counters when they come into view
const statItems = document.querySelectorAll('.stat-item[data-count]');
const counterObserver = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
            const statItem = entry.target;
            const target = parseInt(statItem.getAttribute('data-count')) || 0;
            const suffix = statItem.getAttribute('data-suffix') || '+';
            const statNumber = statItem.querySelector('.stat-number, h3');
            
            if (statNumber && target > 0) {
                statItem.classList.add('counted');
                statNumber.textContent = '0' + suffix;
                animateCounter(statNumber, target, suffix, 2000);
            }
            counterObserver.unobserve(statItem);
        }
    });
}, { threshold: 0.3 });

statItems.forEach(stat => {
    counterObserver.observe(stat);
});

// Enhanced card hover effects
document.querySelectorAll('.service-card, .treatment-card, .pricing-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
    });
});

// Text reveal animation
function revealText() {
    const textElements = document.querySelectorAll('.text-reveal');
    textElements.forEach(element => {
        const text = element.textContent;
        element.innerHTML = '';
        text.split('').forEach((char, index) => {
            const span = document.createElement('span');
            span.textContent = char === ' ' ? '\u00A0' : char;
            span.style.transitionDelay = `${index * 0.05}s`;
            element.appendChild(span);
        });
        observer.observe(element);
    });
}

// Initialize text reveal on load
document.addEventListener('DOMContentLoaded', revealText);

// Smooth page transitions
document.querySelectorAll('a[href^="/"]').forEach(link => {
    link.addEventListener('click', function(e) {
        if (!this.getAttribute('href').startsWith('#')) {
            document.body.style.opacity = '0.8';
            document.body.style.transition = 'opacity 0.3s';
        }
    });
});

// Loading animation
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
    const loader = document.querySelector('.loader');
    if (loader) {
        loader.style.display = 'none';
    }
});

// Back to Top Button
const backToTopButton = document.getElementById('back-to-top');
if (backToTopButton) {
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });

    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Image lazy loading
if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[data-src]');
    images.forEach(img => {
        img.src = img.dataset.src;
    });
} else {
    // Fallback for browsers that don't support lazy loading
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(script);
}

// Newsletter Form AJAX Submission
const newsletterForm = document.getElementById('newsletterForm');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const emailInput = document.getElementById('newsletter-email');
        const submitButton = document.getElementById('newsletter-submit');
        const buttonText = submitButton.querySelector('.button-text');
        const buttonLoader = submitButton.querySelector('.button-loader');
        const errorDiv = document.getElementById('newsletter-error');
        const successDiv = document.getElementById('newsletter-success');
        const email = emailInput.value.trim();
        
        // Reset states
        errorDiv.textContent = '';
        errorDiv.style.display = 'none';
        successDiv.style.display = 'none';
        emailInput.classList.remove('error');
        
        // Basic validation
        if (!email) {
            showNewsletterError('Please enter your email address');
            return;
        }
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNewsletterError('Please enter a valid email address');
            return;
        }
        
        // Show loading state
        submitButton.disabled = true;
        buttonText.style.display = 'none';
        buttonLoader.style.display = 'inline';
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         form.querySelector('input[name="_token"]')?.value;
        
        // Submit via AJAX
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            return response.json().then(data => {
                return {
                    ok: response.ok,
                    status: response.status,
                    data: data
                };
            }).catch(() => {
                // If response is not JSON, return error
                return {
                    ok: false,
                    status: response.status,
                    data: { message: 'Server error. Please try again.' }
                };
            });
        })
        .then(result => {
            // Reset button state
            submitButton.disabled = false;
            buttonText.style.display = 'inline';
            buttonLoader.style.display = 'none';
            
            if (result.ok && result.data.success) {
                // Show success message
                successDiv.textContent = result.data.message || 'Thank you for subscribing to our newsletter!';
                successDiv.style.display = 'block';
                emailInput.value = '';
                emailInput.classList.remove('error');
                errorDiv.style.display = 'none';
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    successDiv.style.display = 'none';
                }, 5000);
            } else {
                // Show error message
                const errorMessage = result.data.errors?.email?.[0] || 
                                   result.data.message || 
                                   'Something went wrong. Please try again.';
                showNewsletterError(errorMessage);
            }
        })
        .catch(error => {
            // Reset button state
            submitButton.disabled = false;
            buttonText.style.display = 'inline';
            buttonLoader.style.display = 'none';
            
            showNewsletterError('Network error. Please check your connection and try again.');
            console.error('Newsletter subscription error:', error);
        });
    });
}

function showNewsletterError(message) {
    const errorDiv = document.getElementById('newsletter-error');
    const emailInput = document.getElementById('newsletter-email');
    
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
    emailInput.classList.add('error');
}

// Form validation enhancement
document.querySelectorAll('form').forEach(form => {
    if (form.id === 'newsletterForm') return; // Skip newsletter form as it has custom handling
    
    const inputs = form.querySelectorAll('input, textarea, select');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    });
});

function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let errorMessage = '';

    // Remove previous error styling
    field.classList.remove('error');
    const existingError = field.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Required field validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required';
    }

    // Email validation
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
    }

    // Phone validation
    if (field.type === 'tel' && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]+$/;
        if (!phoneRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number';
        }
    }

    // Show error if invalid
    if (!isValid) {
        field.classList.add('error');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = errorMessage;
        errorDiv.setAttribute('role', 'alert');
        field.parentElement.appendChild(errorDiv);
    }

    return isValid;
}

// Add loading state to forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner"></span> Processing...';
        }
    });
});

// Add spinner CSS
const style = document.createElement('style');
style.textContent = `
    .spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: currentColor;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    .form-control.error,
    .booking-form input.error,
    .booking-form textarea.error,
    .contact-form input.error,
    .contact-form textarea.error {
        border-color: #dc3545;
    }
`;
document.head.appendChild(style);


