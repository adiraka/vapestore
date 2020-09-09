<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_detail';

    protected $fillable = ['name'];

    public function user() {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
