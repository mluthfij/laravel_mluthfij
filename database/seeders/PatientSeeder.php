<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals = Hospital::all();
        
        if ($hospitals->isEmpty()) {
            $this->command->warn('No hospitals found. Please run HospitalSeeder first.');
            return;
        }

        Patient::factory(50)->create();
        
        Patient::create([
            'name' => 'Ahmad Wijaya',
            'address' => 'Jl. Sudirman No. 123, Jakarta Selatan, DKI Jakarta',
            'phone_number' => '081234567890',
            'hospital_id' => $hospitals->first()->id,
        ]);

        Patient::create([
            'name' => 'Siti Nurhaliza',
            'address' => 'Jl. Gatot Subroto No. 456, Bandung, Jawa Barat',
            'phone_number' => '081234567891',
            'hospital_id' => $hospitals->skip(1)->first()->id ?? $hospitals->first()->id,
        ]);

        Patient::create([
            'name' => 'Budi Santoso',
            'address' => 'Jl. Malioboro No. 789, Yogyakarta, DIY',
            'phone_number' => '081234567892',
            'hospital_id' => $hospitals->skip(2)->first()->id ?? $hospitals->first()->id,
        ]);

        foreach ($hospitals as $hospital) {
            $patientCount = rand(3, 5);
            Patient::factory($patientCount)->create([
                'hospital_id' => $hospital->id,
            ]);
        }
    }
}
