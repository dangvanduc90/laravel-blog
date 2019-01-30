<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
require __DIR__  . './../../../vendor/autoload.php';
// Use below for direct download installation
// require __DIR__  . '/PayPal-PHP-SDK/autoload.php';

class PaypalController extends Controller
{
    public function index()
    {
        return view('paypal.index');
    }
    public function success()
    {
        return view('paypal.success');
    }
    public function error()
    {
        return view('paypal.error');
    }
}
