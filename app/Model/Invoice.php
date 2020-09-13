<?php

namespace App\Model;

use App\User;
use App\Model\Order;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    public function user() {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function order() {
    	return $this->hasOne(Order::class, 'invoice_id');
    }
}
