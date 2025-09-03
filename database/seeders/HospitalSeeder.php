<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::factory(15)->create();
        
        Hospital::create([
            'name' => 'Rumah Sakit Umum Daerah Jakarta',
            'address' => 'Jl. Salemba Raya No. 6, Senen, Jakarta Pusat, DKI Jakarta',
            'email' => 'info@rsud-jakarta.go.id',
            'phone_number' => '021-4249111',
        ]);

        Hospital::create([
            'name' => 'Rumah Sakit Cipto Mangunkusumo',
            'address' => 'Jl. Diponegoro No. 71, Menteng, Jakarta Pusat, DKI Jakarta',
            'email' => 'info@rscm.co.id',
            'phone_number' => '021-1500135',
        ]);

        Hospital::create([
            'name' => 'Rumah Sakit Dr. Sardjito',
            'address' => 'Jl. Kesehatan No. 1, Sekip, Yogyakarta, DIY',
            'email' => 'info@sardjito.co.id',
            'phone_number' => '0274-587333',
        ]);
    }
}
