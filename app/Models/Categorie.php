<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
    ];

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }
}
