@extends('layouts.authenticated')

@section('title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    </div>
</div>

<!-- Main Content -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Message -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">Welcome, {{ $user['name'] }}!</h2>
                <p class="mt-2 text-gray-600">You're logged in to your Velocix application.</p>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    This is your application dashboard. You can customize this page to show any content you'd like.
                </p>
                <div class="space-y-2 text-sm text-gray-600">
                    <p>• Edit this file at <code class="bg-gray-100 px-2 py-1 rounded">resources/views/dashboard.vlx.php</code></p>
                    <p>• Your routes are defined in <code class="bg-gray-100 px-2 py-1 rounded">routes/web.php</code></p>
                    <p>• Controllers live in <code class="bg-gray-100 px-2 py-1 rounded">app/Http/Controllers/</code></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection