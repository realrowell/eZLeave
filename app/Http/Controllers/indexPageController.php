<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexPageController extends Controller
{
    public function index(){
        return view('home_login');
    }
}
