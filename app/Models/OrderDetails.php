<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Cinebaz\Media\Models\Media;
use App\Models\Member;

class OrderDetails extends Model
{
    use HasFactory;
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function medias()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
