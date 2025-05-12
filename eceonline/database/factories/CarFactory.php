<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    /**
     * Collection of realistic car image URLs from Unsplash
     */
    private function getCarImageUrl(): string
    {
        // Curated collection of high-quality car photos from Unsplash - Random Image Samples
        $carImages = [
            'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800',
            'https://images.unsplash.com/photo-1573950940509-d924ee3fd345?w=800',
            'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800',
            'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800',
            'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800',
            'https://images.unsplash.com/photo-1616422285623-13ff0162193c?w=800',
            'https://images.unsplash.com/photo-1619682817481-e994891cd1f5?w=800',
            'https://images.unsplash.com/photo-1606611013016-969c19ba27bb?w=800',
            'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=800',
            'https://images.unsplash.com/photo-1617654112368-307921291f42?w=800',
            'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
        ];

        return $this->faker->randomElement($carImages);
    }

    public function definition(): array
    {
        $carBrands = ['Toyota', 'Honda', 'Ford', 'BMW', 'Mercedes', 'Volkswagen', 'Hyundai', 'Kia'];
        $carTypes = ['Sedan', 'SUV', 'Hatchback', 'Van', 'Pickup', 'Sports Car'];
        $carColors = ['Black', 'White', 'Silver', 'Red', 'Blue', 'Grey', 'Brown'];

        $brand = $this->faker->randomElement($carBrands);
        
        // Brand-specific models
        $brandModels = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4', 'Fortuner', 'Hilux'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'HR-V', 'City'],
            'Ford' => ['Ranger', 'Everest', 'Territory', 'Mustang'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5', '7 Series'],
            'Mercedes' => ['C-Class', 'E-Class', 'GLC', 'GLE', 'S-Class'],
            'Volkswagen' => ['Golf', 'Tiguan', 'Polo', 'T-Cross'],
            'Hyundai' => ['Tucson', 'Santa Fe', 'i30', 'Kona', 'Venue'],
            'Kia' => ['Seltos', 'Sportage', 'Carnival', 'Sorento']
        ];

        return [
            'branch_id' => Branch::factory(),
            'car_brand' => $brand,
            'car_model' => $this->faker->randomElement($brandModels[$brand]),
            'car_color' => $this->faker->randomElement($carColors),
            'car_type' => $this->faker->randomElement($carTypes),
            'car_transmission' => $this->faker->randomElement([0, 1]), // 0 for Manual, 1 for Automatic
            'car_generation' => $this->faker->numberBetween(2015, 2025),
            'car_description' => $this->faker->sentence(),
            'car_image_url' => $this->getCarImageUrl(),
        ];
    }
}