@extends('layouts.app')

@section('title', 'Welcome - Velocix')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-4">Welcome to Velocix</h1>
                <p class="text-gray-600 mb-6">
                    You're logged in! This is your application dashboard.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-2">Fast</h3>
                        <p class="text-gray-600 text-sm">
                            Lightning-fast SPA navigation without full page reloads.
                        </p>
                    </div>
                    
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-2">Simple</h3>
                        <p class="text-gray-600 text-sm">
                            Easy to learn and use, inspired by Laravel.
                        </p>
                    </div>
                    
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-2">Flexible</h3>
                        <p class="text-gray-600 text-sm">
                            Build anything from APIs to full-stack applications.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection