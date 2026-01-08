<?php

namespace App\Http\Controllers;

use Velocix\Http\Controller;
use Velocix\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // For SPA requests
        if ($request->ajax() || $request->wantsJson()) {
            return $this->json([
                'html' => view('welcome', ['title' => 'Welcome'])->render(),
                'title' => 'Welcome'
            ]);
        }

        // For full page load (SSR)
        return $this->view('welcome', [
            'title' => 'Welcome to Velocix'
        ]);
    }

    public function show(Request $request, $id)
    {
        return $this->json([
            'id' => $id,
            'message' => 'Show method'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        return $this->json([
            'message' => 'Created successfully',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        return $this->json([
            'message' => 'Updated successfully',
            'id' => $id,
            'data' => $data
        ]);
    }

    public function destroy(Request $request, $id)
    {
        return $this->json([
            'message' => 'Deleted successfully',
            'id' => $id
        ]);
    }
}