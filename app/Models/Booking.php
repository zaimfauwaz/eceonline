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

    protected $casts = [
        'booking_start' => 'datetime',
        'booking_end' => 'datetime',
        'approved_by' => 'integer',
        'user_id' => 'integer',
        'booking_status' => 'integer',
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

    public function getStatusAttribute()
    {
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Rejected',
        ];

        return $statuses[$this->booking_status] ?? 'Unknown';
    }
}
