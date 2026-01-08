@extends('layouts.app')

@section('title', 'Welcome - Velocix Framework')

@section('content')
<!-- Hero Section -->
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Velocix Framework</span>
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-600 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                A modern PHP framework for building fast web applications with SPA support.
            </p>
            <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                <div class="rounded-md shadow">
                    <a href="/about" data-velocix-link class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition">
                        Documentation
                    </a>
                </div>
                <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                    <a href="https://github.com/trioagus/velocix-framework" class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition">
                        GitHub
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-gray-600 font-semibold tracking-wide uppercase">Features</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Everything you need to build modern apps
            </p>
        </div>

        <div class="mt-10">
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Lightning Fast</h3>
                        <p class="mt-2 text-base text-gray-600">
                            Optimized routing with minimal overhead. Built-in SPA router for smooth navigation.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Elegant Syntax</h3>
                        <p class="mt-2 text-base text-gray-600">
                            Clean, expressive syntax. Blade-like templating engine that's intuitive and powerful.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Secure by Default</h3>
                        <p class="mt-2 text-base text-gray-600">
                            Built-in XSS protection, CSRF tokens, and prepared statements.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Powerful ORM</h3>
                        <p class="mt-2 text-base text-gray-600">
                            Elegant database interactions with query builder and relationship support.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Modern Tooling</h3>
                        <p class="mt-2 text-base text-gray-600">
                            Vite integration for modern asset bundling with hot module replacement.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="relative">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-900 text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Well Documented</h3>
                        <p class="mt-2 text-base text-gray-600">
                            Comprehensive documentation and examples to get you started quickly.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer CTA -->
<div class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto text-center py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            <span class="block">Ready to get started?</span>
        </h2>
        <div class="mt-8 flex justify-center">
            <div class="inline-flex rounded-md shadow">
                <a href="/register" data-velocix-link class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 transition">
                    Sign up
                </a>
            </div>
            <div class="ml-3 inline-flex">
                <a href="/login" data-velocix-link class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                    Log in
                </a>
            </div>
        </div>
    </div>
</div>
@endsection