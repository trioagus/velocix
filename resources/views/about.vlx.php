@extends('layouts.app')

@section('title', 'About - Velocix Framework')

@section('content')
<!-- Hero Section -->
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                About Velocix
            </h1>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                A modern PHP framework built for developers who value simplicity and speed.
            </p>
        </div>
    </div>
</div>

<!-- Story Section -->
<div class="bg-gray-50">
    <div class="max-w-3xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg text-gray-600">
            <p class="text-lg leading-relaxed">
                Velocix was born from a simple idea: web development should be fast, enjoyable, and productive. We combined the best aspects of modern PHP frameworks with innovative SPA capabilities to create something truly special.
            </p>
            <p class="leading-relaxed mt-4">
                Traditional server-side rendering meets modern single-page application smoothness. You get the SEO benefits and simplicity of server rendering, plus the snappy user experience of client-side navigation.
            </p>
            <p class="leading-relaxed mt-4">
                We believe in convention over configuration, but we also give you the flexibility to build exactly what you need. Whether you're creating a simple blog or a complex enterprise application, Velocix scales with your needs.
            </p>
        </div>

        <div class="mt-12 border-t border-gray-200 pt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Core Features</h2>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-gray-900 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Built-in SPA router with server-side rendering support</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-gray-900 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Blade-like templating engine for clean, readable views</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-gray-900 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Powerful ORM with relationship support</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-gray-900 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Vite integration for modern asset bundling</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-gray-900 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>SEO-friendly by default with server rendering</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-gray-900 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Built-in authentication and security features</span>
                </li>
            </ul>
        </div>

        <div class="mt-12 text-center">
            <a href="/" data-velocix-link class="text-gray-600 hover:text-gray-900">
                ← Back to Home
            </a>
        </div>
    </div>
</div>
@endsection