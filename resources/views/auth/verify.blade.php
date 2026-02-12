@extends('layouts.app')

@section('title', 'Verify Email - Golden Sky Hotel & Wellness')

@section('content')
<div class="bg-gradient-to-b from-gold-light to-white py-12 min-h-screen">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl p-8">
            <h1 class="text-3xl font-bold text-gold-dark mb-6 text-center">Verify Your Email</h1>

            @if (session('resent'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    <p>A fresh verification link has been sent to your email address.</p>
                </div>
            @endif

            <p class="text-gray-700 mb-6">
                Before proceeding, please check your email for a verification link. 
                If you did not receive the email, click the button below to request another.
            </p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-gold hover:bg-gold-dark text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Resend Verification Email
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-gold hover:text-gold-dark font-semibold">Logout</a>
            </p>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection



















































































