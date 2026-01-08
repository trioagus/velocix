@extends('layouts.app')

@section('title', 'About - Velocix')

@section('content')
<div>
    <h1 class="text-4xl font-bold text-center mb-8">
        About Velocix
    </h1>
    
    <div class="max-w-3xl mx-auto">
        <p class="text-lg text-gray-600 mb-6">
            Velocix is a modern PHP framework designed for building fast, lightweight web applications with SPA capabilities.
        </p>
        
        <p class="text-lg text-gray-600 mb-6">
            It combines the simplicity of traditional server-side rendering with the smooth user experience of single-page applications.
        </p>

        <div class="bg-blue-100 p-6 rounded-lg mt-8">
            <h2 class="text-2xl font-bold mb-4">Key Features</h2>
            <ul class="space-y-2 text-gray-700">
                <li>✓ Built-in SPA router with SSR support</li>
                <li>✓ Blade-like templating engine</li>
                <li>✓ Vite integration for modern asset bundling</li>
                <li>✓ SEO-friendly by default</li>
                <li>✓ No complex build tools required</li>
            </ul>
        </div>

        <div class="text-center mt-12">
            <a href="/" data-velocix-link class="text-blue-600 hover:underline">
                ← Back to Home
            </a>
        </div>
    </div>
</div>
@endsection