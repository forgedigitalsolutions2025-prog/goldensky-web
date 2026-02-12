<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Anna Hilto',
                'location' => 'Australia',
                'testimonial' => 'My skin has never felt this fresh and radiant. The herbal facial left me glowing naturally. Truly a rejuvenating experience rooted in traditional Ayurvedic care.',
                'image' => 'testimonial-1.jpg',
                'rating' => 5,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Senjuti das',
                'location' => 'Canada',
                'testimonial' => 'Shirodhara was deeply calming. The warm oil flow soothed my mind, reduced anxiety, and gave me the most peaceful sleep I\'ve had in years. Pure Ayurvedic bliss!',
                'image' => 'testimonial-2.jpg',
                'rating' => 5,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Abella Gray',
                'location' => 'United Kingdom',
                'testimonial' => 'The full body massage was divine. Every stroke felt therapeutic and healing. I felt detoxified, relaxed, and completely renewed. This is true holistic wellness, the Ceylon way!',
                'image' => 'testimonial-3.jpg',
                'rating' => 5,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Maria Silva',
                'location' => 'Brazil',
                'testimonial' => 'The Tharpana treatment was incredible for my eyes. After years of strain from computer work, this ancient Ayurvedic therapy brought such relief and clarity.',
                'image' => 'testimonial-4.jpg',
                'rating' => 5,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'John Peterson',
                'location' => 'United States',
                'testimonial' => 'The herbal bath was transformative. My skin feels renewed, and the overall experience was deeply relaxing. Shadhara Wellness truly embodies authentic Ceylon healing.',
                'image' => 'testimonial-5.jpg',
                'rating' => 5,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}


