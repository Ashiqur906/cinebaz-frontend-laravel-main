<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cinebaz\Media\Models\Media;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'title_bangla', 'title_english', 'title_hindi', 'slug', 'menu_show', 'page_show', 'home_show',
        'is_active',  'create_by', 'modified_by',

    ];

    public function images()
    {
        // return $this->morphMany('Cinebaz\Category\Models\CategoryPicture', 'imageable');
    }
    public function allimages()
    {
        return $this->morphMany('Cinebaz\Category\Models\CategoryPicture'::class, 'imageable');
    }
    public function medias()
    {
        return $this->belongsToMany(Media::class, 'media_category');
    }
}
