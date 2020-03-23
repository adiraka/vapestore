<?php

namespace App\Model;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'merks';

    public function products() {
        return $this->hasMany(Product::class, 'merk_id');
    }
}
