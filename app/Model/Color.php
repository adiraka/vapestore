<?php

namespace App\Model;

use App\Model\Varian;

class Color
{
    protected $table = 'colors';

    public function varians() {
    	return $this->hasMany(Varian::class, 'color_id');
    }
}
