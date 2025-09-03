<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hospital>
 */
class HospitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hospitalNames = [
            'Rumah Sakit Umum Daerah',
            'Rumah Sakit Cipto Mangunkusumo',
            'Rumah Sakit Dr. Sardjito',
            'Rumah Sakit Hasan Sadikin',
            'Rumah Sakit Kariadi',
            'Rumah Sakit Dr. Soetomo',
            'Rumah Sakit Fatmawati',
            'Rumah Sakit Persahabatan',
            'Rumah Sakit Siloam',
            'Rumah Sakit Pondok Indah',
            'Rumah Sakit Medistra',
            'Rumah Sakit Mayapada',
            'Rumah Sakit Omni',
            'Rumah Sakit Eka Hospital',
            'Rumah Sakit Mitra Keluarga',
            'Rumah Sakit Hermina',
            'Rumah Sakit Bunda',
            'Rumah Sakit Ibu dan Anak',
            'Rumah Sakit Mata',
            'Rumah Sakit Jiwa'
        ];

        $cities = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang',
            'Makassar', 'Palembang', 'Tangerang', 'Depok', 'Bekasi',
            'Yogyakarta', 'Malang', 'Solo', 'Balikpapan', 'Batam'
        ];

        $name = $this->faker->randomElement($hospitalNames) . ' ' . $this->faker->randomElement($cities);
        
        return [
            'name' => $name,
            'address' => $this->faker->streetAddress() . ', ' . $this->faker->randomElement($cities) . ', ' . $this->faker->state(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
