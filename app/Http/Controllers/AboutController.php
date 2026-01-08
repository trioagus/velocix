<?php

namespace App\Http\Controllers;

use Velocix\Http\Controller;
use Velocix\Http\Request;
use Velocix\Http\SpaSupport;

class AboutController extends Controller
{
  use SpaSupport;

  
    public function index(Request $request)
    {
        if ($this->isSpaRequest()) {
        error_log("SPA Request detected!");
    }
    
    return $this->spaView('about', [
        'title' => 'About - Velocix'
    ]);

        // For full page load (SSR)
        return $this->view('about', [
            'title' => 'about to Velocix'
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