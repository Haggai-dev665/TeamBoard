@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-4rem)] p-6">
    <div class="max-w-md w-full text-center">
        <div class="mb-8">
            <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Access Pending</h1>
            <p class="text-lg text-gray-600 mb-6">
                Your account has been created, but you haven't been registered as an employee yet.
            </p>
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 text-left mb-6">
                <h3 class="font-semibold text-blue-900 mb-2">What does this mean?</h3>
                <p class="text-sm text-blue-800 mb-4">
                    To access notices, documents, and other features, you need to be added to the employee directory by your administrator.
                </p>
                <h3 class="font-semibold text-blue-900 mb-2">What should you do?</h3>
                <p class="text-sm text-blue-800">
                    Please contact your system administrator to add you as an employee. They will need your email address: <strong>{{ auth()->user()->email }}</strong>
                </p>
            </div>
        </div>

        <div class="space-y-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-6 py-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors font-medium">
                    Logout
                </button>
            </form>
            <p class="text-sm text-gray-500">
                Already been added? Try refreshing the page.
            </p>
        </div>
    </div>
</div>
@endsection
