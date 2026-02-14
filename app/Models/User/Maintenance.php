<?php

namespace App\Models\User;

use App\Models\User;
use App\Models\User\Car;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'marca',
        'numero',
        'price',
        'km',
        'fecEmit',
        'fecRenov',
        'imagen',
        'car_id',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
