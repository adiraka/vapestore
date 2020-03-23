<?php

namespace App\Model;

use App\Model\Product;
use App\Model\Color;
use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
    protected $table = 'varians';

    public function product() {
    	return $this->belongsTo(Product::class, 'product_id');
    }

    public function color() {
    	return $this->belongsTo(Color::class, 'color_id');
    }
}
