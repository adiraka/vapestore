<?php

namespace App\Model;

use App\User;
use App\Model\Invoice;
use App\Model\OrderDetail;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function invoice() {
    	return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function user() {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function detail() {
    	return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
