<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        // Remove duplicate treatments, keeping only the first one for each name
        $uniqueNames = Treatment::select('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('name');
        
        foreach ($uniqueNames as $name) {
            $first = Treatment::where('name', $name)
                ->orderBy('id')
                ->first();
            
            if ($first) {
                Treatment::where('name', $name)
                    ->where('id', '!=', $first->id)
                    ->delete();
            }
        }

        $treatments = [
            [
                'name' => 'Body Massage',
                'description' => 'Full-body herbal massage that soothes muscles, boosts energy, and improves circulation.',
                'image' => 'treatment.jpg',
                'price' => 25.00,
                'duration' => 60,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Steam Bath',
                'description' => 'Opens pores, detoxifies the body, enhances circulation, and deeply relaxes your senses.',
                'image' => 'bath.jpg',
                'price' => 35.00,
                'duration' => 45,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Facial Treatment',
                'description' => 'Cleanses, hydrates, and rejuvenates skin using natural Ayurvedic herbs and techniques.',
                'image' => 'facial.jpg',
                'price' => 30.00,
                'duration' => 45,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Head Massage',
                'description' => 'Stimulates scalp, relieves stress, improves sleep, and promotes healthy hair growth naturally.',
                'image' => 'head.jpg',
                'price' => 20.00,
                'duration' => 30,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Shirodhara',
                'description' => 'A calming oil flow therapy that balances mind, relieves anxiety, and improves clarity.',
                'image' => 'shirp.jpg',
                'price' => 40.00,
                'duration' => 60,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Herbal Bath',
                'description' => 'Soothing herbal soak that detoxifies, softens skin, and revitalizes the entire body.',
                'image' => 'facial-1.jpg',
                'price' => 35.00,
                'duration' => 45,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Foot Treatements',
                'description' => 'Ayurvedic foot massage that relieves fatigue, improves blood flow, and calms the nerves.',
                'image' => 'foot-massage.jpg',
                'price' => 25.00,
                'duration' => 30,
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Akshi Tarpana',
                'description' => 'Akshi Tharpana is a specialized Ayurvedic treatment for the eyes.',
                'image' => 'tharpana.jpg',
                'price' => 35.00,
                'duration' => 45,
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($treatments as $treatment) {
            Treatment::updateOrCreate(
                ['name' => $treatment['name']],
                $treatment
            );
        }
    }
}
