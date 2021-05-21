<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Poster extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'image',
        'price', 'site', 'date', 'description',
        'address', 'phones', 'latitude',
        'longitude', 'comments_quantity',
        'likes_quantity', 'is_liked'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function galleryPoster(): HasOne
    {
        return $this->hasOne(GalleryPoster::class);
    }

    public function recommendation(): HasOne
    {
        return $this->hasOne(PosterRecommendation::class);
    }
}
