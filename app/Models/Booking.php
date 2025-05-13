<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'user_id',
        'approved_by',
        'booking_start',
        'booking_end',
        'booking_status',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'booking_cars', 'booking_id', 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'user_id');
    }
}
