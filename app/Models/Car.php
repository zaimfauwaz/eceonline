<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = 'car_id';
    protected $fillable = [
        'branch_id',
        'car_brand',
        'car_model',
        'car_color',
        'car_type',
        'car_transmission',
        'car_generation',
        'car_description',
        'car_image_url',
        'car_mileage',
        'car_horsepower',
        'car_top_speed',
        'car_fuel_type',
        'car_seats',
        'car_engine',
        'car_market_price'
    ];

    protected $casts = [
        'car_transmission' => 'boolean',
        'car_generation' => 'integer',
        'car_mileage' => 'integer',
        'car_horsepower' => 'integer',
        'car_top_speed' => 'integer',
        'car_seats' => 'integer',
        'car_market_price' => 'integer'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_cars', 'car_id', 'booking_id');
    }

    public function getTransmissionTypeAttribute()
    {
        return $this->car_transmission == 0 ? 'Manual' : 'Automatic';
    }
}
