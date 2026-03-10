<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionDemoController extends Controller
{
   public function index(){

    // session(['favourite_color' => 'blue']);

    // $session = session('favourite_color');

    // session()->flash('status', 'You visited new page');

    // session()->forget('favourite_color');

    // session()->flush();
    
    $session = session()->all();



    return $session;
   }
}
