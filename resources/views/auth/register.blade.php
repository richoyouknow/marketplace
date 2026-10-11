@extends('layouts.app')

@section('title', 'Register - Odaplace')

@section('content')
<div class="max-w-md mx-auto px-4 mt-12 mb-24">
    <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Create an Account</h1>
            <p class="text-gray-500">Join Odaplace to start shopping</p>
        </div>
        
        <form action="#" class="space-y-4" onsubmit="event.preventDefault(); window.location.href='{{ route('home') }}'">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="John Doe">
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="you@example.com">
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="••••••••">
            </div>
            
            <div class="flex items-start gap-2 pt-2 pb-4">
                <input type="checkbox" id="terms" required class="mt-1 w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">
                <label for="terms" class="text-sm text-gray-600">I agree to the <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>.</label>
            </div>
            
            <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-lg font-bold transition-colors">
                Create Account
            </button>
        </form>
        
        <div class="mt-8 text-center text-sm text-gray-500">
            Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Sign in</a>
        </div>
    </div>
</div>
@endsection
