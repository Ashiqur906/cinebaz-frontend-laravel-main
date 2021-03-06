<?php

namespace Cinebaz\Member\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cinebaz\Pricing\Models\SubscriptionHead;
class Order extends Model
{
    use HasFactory;

    protected $guard = 'member';
    protected $table = 'orders';

    public function PlanHead()
    {
        return $this->hasOne(SubscriptionHead::class, 'id', 'sub_head_id');
    }
}
