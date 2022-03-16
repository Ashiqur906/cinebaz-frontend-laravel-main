<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cinebaz\Media\Models\Media;
use App\Models\Seo;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'genres';
    protected $fillable = [
        'title_en', 'title_bn', 'title_hn', 'slug', 'description_en', 'description_bn', 'description_hn',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by'
    ];



    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
    public function medias()
    {
        return $this->belongsToMany(Media::class, 'media_genre');
    }
}
