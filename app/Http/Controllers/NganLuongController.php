<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NganLuongController extends Controller
{
    public function index()
    {
        return view('nganluong.index');
    }
}
