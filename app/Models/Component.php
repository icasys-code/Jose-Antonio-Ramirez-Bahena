<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'part_number',
        'description',
    ];

    public function parts()
    {
        return $this->belongsToMany(Part::class, 'component_part', 'component_id', 'part_id')
            ->withPivot(['role','quantity'])
            ->withTimestamps();
    }
}
