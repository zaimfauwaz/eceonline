<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';
    protected $primaryKey = 'branch_id';
    protected $fillable = [
        'branch_name',
        'branch_location',
        'branch_phone',
        'branch_email',
        'branch_status',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'branch_id', 'branch_id');
    }
}
