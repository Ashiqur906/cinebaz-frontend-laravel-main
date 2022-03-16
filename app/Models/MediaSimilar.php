<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cinebaz\Media\Models\Media;

class MediaSimilar extends Model
{
    use HasFactory;

    public function media()
    {
        return $this->belongsTo(Media::class, 'similar_id', 'id');
    }
    static function mediaSimilar($media_id)
    {
        return MediaSimilar::where('media_id', $media_id)->get();
    }
}
