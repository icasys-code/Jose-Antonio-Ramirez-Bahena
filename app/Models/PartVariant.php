<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartVariant extends Model
{
    use HasFactory;

    protected $table = 'part_variant';

    protected $fillable = [
        'part_id',
        'car_variant_id',
        'fitment_notes',
        'direct_fit',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id');
    }

    public function carVariant()
    {
        return $this->belongsTo(CarVariant::class, 'car_variant_id');
    }
}
