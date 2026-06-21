<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'car_variant_id',
        'vin',
        'stock_code',
        'year',
        'color',
        'mileage',
        'price',
        'condition',
        'description',
    ];

    public function variant()
    {
        return $this->belongsTo(CarVariant::class, 'car_variant_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
