<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cinebaz\Media\Models\Media;

class PlayListLog extends Model
{
    use HasFactory;
    protected $table = 'play_list_logs';
    protected $fillable = [
        'video_id', 'member_id', 'ip', 'session_id', 'pre_time', 'last_watchtime'
    ];
    public function media()
    {
        return $this->belongsTo(Media::class, 'video_id', 'id');
    }
    static function mediaSimilar($media_id)
    {
        return MediaSimilar::where('media_id', $media_id)->get();
    }
    static function SimilarMedia($media_id)
    {
        return Media::where('id', $media_id)->first();
    }
}
