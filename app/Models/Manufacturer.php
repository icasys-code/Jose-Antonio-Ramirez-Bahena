<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'country',
        'description',
        'website',
    ];

    public function parts()
    {
        return $this->hasMany(Part::class, 'manufacturer_id');
    }
}
