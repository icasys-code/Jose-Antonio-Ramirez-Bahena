<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Part extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku',
        'name',
        'category_id',
        'manufacturer_id',
        'description',
        'price',
        'currency',
        'weight',
        'dimensions',
        'stock',
        'active',
    ];

    protected $casts = [
        'dimensions' => 'array',
        'price' => 'decimal:2',
        'weight' => 'decimal:3',
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_part', 'part_id', 'component_id')
            ->withPivot(['role','quantity'])
            ->withTimestamps();
    }

    public function carVariants()
    {
        return $this->belongsToMany(CarVariant::class, 'part_variant', 'part_id', 'car_variant_id')
            ->withPivot(['fitment_notes','direct_fit'])
            ->withTimestamps();
    }
}
