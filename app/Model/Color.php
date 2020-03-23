<?php

namespace App\Model;

use App\Model\Varian;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    public function varians() {
    	return $this->hasMany(Varian::class, 'color_id');
    }
}
