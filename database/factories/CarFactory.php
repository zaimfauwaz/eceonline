<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    private $brandTiers = [
        'Premium' => ['BMW', 'Mercedes'],
        'Upper' => ['Volkswagen', 'Ford'],
        'Mid' => ['Toyota', 'Honda'],
        'Entry' => ['Hyundai', 'Kia']
    ];

    private $typeMultipliers = [
        'Sports Car' => 1.8,
        'SUV' => 1.4,
        'Pickup' => 1.3,
        'Van' => 1.2,
        'Sedan' => 1.0,
        'Hatchback' => 0.9
    ];

    private function calculateMarketPrice(string $brand, string $model, string $type, int $generation, int $mileage, string $engine): float
    {
        // Base price ranges by brand tier
        $basePrices = [
            'Premium' => [50000, 120000],
            'Upper' => [35000, 80000],
            'Mid' => [25000, 60000],
            'Entry' => [20000, 45000]
        ];

        // Find brand tier
        $brandTier = 'Mid'; // Default tier
        foreach ($this->brandTiers as $tier => $brands) {
            if (in_array($brand, $brands)) {
                $brandTier = $tier;
                break;
            }
        }

        // Get base price range for the brand tier
        $baseRange = $basePrices[$brandTier];
        $basePrice = $this->faker->numberBetween($baseRange[0], $baseRange[1]);

        // Apply car type multiplier
        $basePrice *= $this->typeMultipliers[$type];

        // Generation modifier (newer cars are more expensive)
        $yearDiff = $generation - 2015;
        $generationMultiplier = 1 + ($yearDiff * 0.05); // 5% increase per year from 2015
        $basePrice *= $generationMultiplier;

        // Mileage modifier (reduce price based on mileage)
        $mileageDeduction = ($mileage / 10000) * 0.02; // 2% reduction per 10,000 miles
        $basePrice *= (1 - min($mileageDeduction, 0.5)); // Cap reduction at 50%

        // Engine size modifier (larger engines typically cost more)
        if (preg_match('/(\d+\.\d+)L/', $engine, $matches)) {
            $engineSize = floatval($matches[1]);
            $basePrice *= (1 + ($engineSize - 2.0) * 0.1); // 10% adjustment per liter difference from 2.0L
        }

        // Round to nearest thousand
        return round($basePrice / 1000) * 1000;
    }

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

        $brandSpecificData = [
            'Toyota' => [
                'models' => ['Camry', 'Corolla', 'RAV4', 'Fortuner', 'Hilux'],
                'engines' => ['1.8L I4', '2.0L I4', '2.5L I4', '3.5L V6'],
                'horsepower' => [140, 169, 203, 301],
                'top_speed' => [180, 190, 200, 220]
            ],
            'Honda' => [
                'models' => ['Civic', 'Accord', 'CR-V', 'HR-V', 'City'],
                'engines' => ['1.5L Turbo I4', '2.0L I4', '1.8L I4'],
                'horsepower' => [158, 174, 192, 212],
                'top_speed' => [175, 185, 200, 210]
            ],
            'Ford' => [
                'models' => ['Ranger', 'Everest', 'Territory', 'Mustang'],
                'engines' => ['2.0L EcoBoost', '2.3L EcoBoost', '5.0L V8'],
                'horsepower' => [245, 310, 460, 480],
                'top_speed' => [190, 200, 250, 270]
            ],
            'BMW' => [
                'models' => ['3 Series', '5 Series', 'X3', 'X5', '7 Series'],
                'engines' => ['2.0L I4 Turbo', '3.0L I6', '4.4L V8'],
                'horsepower' => [248, 335, 456, 523],
                'top_speed' => [210, 240, 250, 280]
            ],
            'Mercedes' => [
                'models' => ['C-Class', 'E-Class', 'GLC', 'GLE', 'S-Class'],
                'engines' => ['2.0L I4 Turbo', '3.0L I6', '4.0L V8'],
                'horsepower' => [255, 362, 469, 503],
                'top_speed' => [210, 240, 250, 280]
            ],
            'Volkswagen' => [
                'models' => ['Golf', 'Tiguan', 'Polo', 'T-Cross'],
                'engines' => ['1.4L TSI', '2.0L TSI', '2.0L TDI'],
                'horsepower' => [150, 184, 228, 300],
                'top_speed' => [180, 200, 220, 250]
            ],
            'Hyundai' => [
                'models' => ['Tucson', 'Santa Fe', 'i30', 'Kona', 'Venue'],
                'engines' => ['1.6L I4', '2.0L I4', '2.4L I4'],
                'horsepower' => [147, 187, 235, 280],
                'top_speed' => [170, 185, 200, 210]
            ],
            'Kia' => [
                'models' => ['Seltos', 'Sportage', 'Carnival', 'Sorento'],
                'engines' => ['1.6L I4', '2.0L I4', '2.5L I4', '3.5L V6'],
                'horsepower' => [146, 187, 281, 290],
                'top_speed' => [175, 185, 200, 210]
            ]
        ];

        $fuelTypes = ['Petrol', 'Diesel', 'Hybrid', 'Electric'];

        $brand = $this->faker->randomElement($carBrands);
        $brandData = $brandSpecificData[$brand];
        $model = $this->faker->randomElement($brandData['models']);
        $engine = $this->faker->randomElement($brandData['engines']);
        $horsepower = $this->faker->randomElement($brandData['horsepower']);
        $top_speed = $this->faker->randomElement($brandData['top_speed']);

        // Determine number of seats based on car type
        $seatsMap = [
            'Sedan' => [5],
            'SUV' => [5, 7],
            'Hatchback' => [5],
            'Van' => [7, 8, 9],
            'Pickup' => [2, 5],
            'Sports Car' => [2, 4]
        ];

        $type = $this->faker->randomElement($carTypes);
        $seats = $this->faker->randomElement($seatsMap[$type]);
        $generation = $this->faker->numberBetween(2015, 2025);
        $mileage = $this->faker->numberBetween(0, 150000);

        return [
            'branch_id' => Branch::factory(),
            'car_brand' => $brand,
            'car_model' => $model,
            'car_color' => $this->faker->randomElement($carColors),
            'car_type' => $type,
            'car_transmission' => $this->faker->randomElement([0, 1]), // 0 for Manual, 1 for Automatic
            'car_generation' => $generation,
            'car_description' => $this->faker->paragraph(2),
            'car_image_url' => $this->getCarImageUrl(),
            'car_mileage' => $mileage,
            'car_horsepower' => $horsepower,
            'car_top_speed' => $top_speed,
            'car_fuel_type' => $this->faker->randomElement($fuelTypes),
            'car_seats' => $seats,
            'car_engine' => $engine,
            'car_market_price' => $this->calculateMarketPrice($brand, $model, $type, $generation, $mileage, $engine),
        ];
    }
}