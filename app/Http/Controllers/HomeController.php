<?php

namespace App\Http\Controllers;

use Velocix\Http\Controller;
use Velocix\Http\Request;
use Velocix\Http\SpaSupport;

class HomeController extends Controller
{
    use SpaSupport;

    public function index()
{
    error_log("HomeController::index() called");
    return $this->spaView('home', [
        'title' => 'Home - Velocix'
    ]);
}
}