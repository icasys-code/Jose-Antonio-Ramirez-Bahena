<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarVariant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'car_model_id',
        'name',
        'trim',
        'engine',
        'transmission',
        'fuel_type',
        'doors',
        'notes',
    ];

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'car_variant_id');
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class, 'part_variant', 'car_variant_id', 'part_id')
            ->withPivot(['fitment_notes','direct_fit'])
            ->withTimestamps();
    }
}
