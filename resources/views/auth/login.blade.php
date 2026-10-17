@extends('layouts.app')

@section('title', 'Login - ALLWEAR FASHION')

@section('content')
<div class="max-w-md mx-auto px-4 mt-12 mb-24">
    <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back</h1>
            <p class="text-gray-500">Sign in to your ALLWEAR FASHION account</p>
        </div>
        
        <form action="#" class="space-y-4" onsubmit="event.preventDefault(); window.location.href='{{ route('home') }}'">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="you@example.com">
            </div>
            
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-sm text-primary hover:underline">Forgot password?</a>
                </div>
                <input type="password" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="••••••••">
            </div>
            
            <div class="flex items-center gap-2 pt-2 pb-4">
                <input type="checkbox" id="remember" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>
            
            <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-lg font-bold transition-colors">
                Sign In
            </button>
        </form>
        
        <div class="mt-8 text-center text-sm text-gray-500">
            Don't have an account? <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Sign up now</a>
        </div>
    </div>
</div>
@endsection
