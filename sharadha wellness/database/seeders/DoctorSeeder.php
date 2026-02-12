<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr. Priyanka Perera',
                'title' => 'Senior Ayurvedic Physician',
                'qualifications' => 'BAMS (Bachelor of Ayurvedic Medicine and Surgery), MD in Ayurveda',
                'specialization' => 'Panchakarma Therapy, Herbal Medicine, Chronic Disease Management',
                'experience' => 'Over 15 years of experience in traditional Ayurvedic healing practices',
                'bio' => 'Dr. Priyanka Perera is a renowned Ayurvedic physician with extensive expertise in traditional Ceylon Ayurveda. She specializes in Panchakarma therapies and has helped thousands of patients achieve optimal health through natural healing methods.',
                'years_of_experience' => 15,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Dr. Chaminda Silva',
                'title' => 'Ayurvedic Doctor',
                'qualifications' => 'BAMS, Certified Panchakarma Specialist',
                'specialization' => 'Shirodhara, Abhyanga, Herbal Spa Treatments',
                'experience' => '12 years of dedicated practice in Ayurvedic wellness and beauty treatments',
                'bio' => 'Dr. Chaminda Silva brings a holistic approach to Ayurvedic healing, focusing on natural beauty and wellness treatments. His expertise in Shirodhara and herbal spa therapies has transformed many lives.',
                'years_of_experience' => 12,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dr. Nimali Fernando',
                'title' => 'Residential Ayurvedic Physician',
                'qualifications' => 'BAMS, Diploma in Traditional Medicine',
                'specialization' => 'Women\'s Health, Hormonal Balance, Stress Management',
                'experience' => '10 years specializing in women\'s wellness and hormonal health through Ayurveda',
                'bio' => 'Dr. Nimali Fernando is our residential physician who provides personalized consultations and treatments. She specializes in women\'s health and offers compassionate care tailored to each individual\'s unique needs.',
                'years_of_experience' => 10,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        // Remove duplicate doctors, keeping only the first one for each name
        $uniqueNames = Doctor::select('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('name');
        
        foreach ($uniqueNames as $name) {
            $first = Doctor::where('name', $name)
                ->orderBy('id')
                ->first();
            
            if ($first) {
                Doctor::where('name', $name)
                    ->where('id', '!=', $first->id)
                    ->delete();
            }
        }

        foreach ($doctors as $doctor) {
            Doctor::updateOrCreate(
                ['name' => $doctor['name']],
                $doctor
            );
        }
    }
}
