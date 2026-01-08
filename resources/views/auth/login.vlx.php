@extends('guest.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                <p class="mt-2 text-gray-600">Sign in to your account to continue</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="/login" method="POST" data-velocix-form id="loginForm">
                    {!! csrf_field() !!}

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" 
                                   name="email" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="john@example.com"
                                   value="{{ old('email') }}">
                            <span class="text-red-500 text-sm mt-1 hidden" data-error="email"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <input type="password" 
                                   name="password" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Enter your password">
                            <span class="text-red-500 text-sm mt-1 hidden" data-error="password"></span>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full mt-6 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition transform hover:scale-[1.02] active:scale-[0.98]">
                        Sign In
                    </button>

                    <p class="mt-6 text-center text-gray-600">
                        Don't have an account? 
                        <a href="/register" data-velocix-link class="text-blue-600 hover:text-blue-700 font-semibold">
                            Create Account
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Handle form submission feedback
        window.addEventListener('velocix:afterSubmit', (e) => {
            // Clear previous errors
            document.querySelectorAll('[data-error]').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });

            if (e.detail.data.errors) {
                // Show validation errors
                Object.keys(e.detail.data.errors).forEach(field => {
                    const errorEl = document.querySelector(`[data-error="${field}"]`);
                    if (errorEl) {
                        errorEl.textContent = e.detail.data.errors[field][0];
                        errorEl.classList.remove('hidden');
                    }
                });
            } else if (e.detail.data.error) {
                alert(e.detail.data.error);
            }
        });
    </script>
@endsection