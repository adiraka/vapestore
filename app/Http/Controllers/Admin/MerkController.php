<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    public function getDashboard() {
        return view('admin.dashboard.dashboard');
    }
}