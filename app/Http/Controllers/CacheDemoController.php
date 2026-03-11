<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheDemoController extends Controller
{
    //
    public function index(){
        // Cache::put('foo', 'hello', 600);
        // Cache::put('abc', 'ABC ENGLISH', 60);
        // Cache::put('numbers', '2312312312');
        // $value = Cache::get('foo');
        // $value = Cache::get('abc', 'not found here');
        // Cache::forget('numbers');
        // Cache::flush(); // delete all

        $value = Cache::get('numbers', 'not found here');

        return $value;
    }
}
