<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_type',
        'gallery_name',
        'gallery_address',
        'gallery_city_state',
        'gallery_country',
        'theme',
        'date',
    ];


    public function artworks()
    {
        return $this->belongsToMany(Artwork::class, 'exposition_artwork')
                    ->withPivot('artwork_id', 'exposition_id');
    }
}
