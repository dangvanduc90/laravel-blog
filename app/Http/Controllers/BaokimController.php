<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaokimController extends Controller
{
    public function index()
    {
        return view('baokim.index');
    }
}
