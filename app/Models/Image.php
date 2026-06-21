<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'disk',
        'mime_type',
        'imageable_id',
        'imageable_type',
        'alt',
        'order',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
