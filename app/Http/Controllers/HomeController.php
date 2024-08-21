<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->Middleware(\App\Http\Middleware\Authenticate::class);
    }
    public function index()
    {
        return view('home.index');
    }
}
