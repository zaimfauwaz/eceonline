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
        'car_name',
        'car_model',
        'car_year',
        'car_color',
        'car_plate_number',
        'branch_id',
        'car_status',
        'car_image_url',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_cars', 'car_id', 'booking_id');
    }
}
