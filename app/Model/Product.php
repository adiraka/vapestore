<?php

namespace App\Model;

use App\Model\Merk;
use App\Model\Varian;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function merk() {
    	return $this->belongsTo(Merk::class, 'merk_id');
    }

    public function varians() {
    	return $this->hasMany(Varian::class, 'product_id');
    }
}
