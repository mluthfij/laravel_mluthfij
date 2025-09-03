<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang',
            'Makassar', 'Palembang', 'Tangerang', 'Depok', 'Bekasi',
            'Yogyakarta', 'Malang', 'Solo', 'Balikpapan', 'Batam'
        ];

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->streetAddress() . ', ' . $this->faker->randomElement($cities) . ', ' . $this->faker->state(),
            'phone_number' => $this->faker->phoneNumber(),
            'hospital_id' => Hospital::factory(),
        ];
    }
}
