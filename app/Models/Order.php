<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubscriptionHead;use App\Models\OrderDetails;
class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function Subscription()
    {
        return $this->hasOne(SubscriptionHead::class, 'id', 'sub_head_id');
    }
    public function Details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
