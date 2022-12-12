<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


class Image extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'images';

    public function Album()
    {
        return $this->belongsTo('App\Models\Album');
    }
}
