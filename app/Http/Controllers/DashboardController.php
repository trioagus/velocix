<?php

namespace App\Http\Controllers;

use Velocix\Http\Controller;
use Velocix\Http\Request;
use Velocix\Auth\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax() || $request->wantsJson()) {
            return $this->json([
                'html' => view('dashboard', compact('user'))->render(),
                'title' => 'Dashboard'
            ]);
        }

        return $this->view('dashboard', compact('user'));
    }
}
