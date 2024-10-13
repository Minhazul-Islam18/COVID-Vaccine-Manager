<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centers = [
            ['name' => 'Modern Hospital Pvt. (Noakhali)', 'daily_limit' => 100],
            ['name' => 'Health Center A', 'daily_limit' => 75],
            ['name' => 'Health Center B', 'daily_limit' => 60],
            ['name' => 'Community Hospital', 'daily_limit' => 80],
            ['name' => 'Central Vaccination Center', 'daily_limit' => 200],
            ['name' => 'Central Vaccination Hub', 'daily_limit' => 90],
            ['name' => 'Westside Medical Center', 'daily_limit' => 110],
            ['name' => 'North District Health Unit', 'daily_limit' => 55],
            ['name' => 'South District Vaccination Center', 'daily_limit' => 65],
            ['name' => 'Regional Health Center', 'daily_limit' => 150],
            ['name' => 'Rural Health Clinic', 'daily_limit' => 30],
            ['name' => 'City Immunization Center', 'daily_limit' => 120],
            ['name' => 'Public Health Service', 'daily_limit' => 85],
            ['name' => 'Village Health Center', 'daily_limit' => 25],
            ['name' => 'Metropolitan Health Clinic', 'daily_limit' => 95],
            ['name' => 'Emergency Health Services', 'daily_limit' => 70],
            ['name' => 'University Health Center', 'daily_limit' => 45],
            ['name' => 'Senior Care Vaccination Center', 'daily_limit' => 40],
        ];

        foreach ($centers as $center) {
            VaccineCenter::create($center);
        }
    }
}
