<?php

namespace App\Model;

use App\Model\Order;
use App\Model\Varian;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    public function order() {
    	return $this->belongsTo(Order::class, 'order_id');
    }

    public function varian() {
    	return $this->belongsTo(Varian::class, 'varian_id');
    }
}
