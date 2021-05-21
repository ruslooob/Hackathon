<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterRecommendation extends Model
{
    use HasFactory;

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }
}
