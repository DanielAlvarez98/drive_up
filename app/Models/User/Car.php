<?php

namespace App\Models\User;

use App\Models\User;
use App\Models\User\Document;
use App\Models\User\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['marca', 'placa', 'anhoFab', 'km', 'modelo', 'imagen', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
