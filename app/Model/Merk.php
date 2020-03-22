<?php

namespace App\Model;

use App\Model\Product;

class Merk
{
    protected $table = 'merks';

    public function products() {
        return $this->hasMany(Product::class, 'merk_id');
    }
}
