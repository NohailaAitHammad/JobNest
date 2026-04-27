@extends('layouts.authLayout')
@section('content')
    <div class="hidden lg:block">
        <img src="../assets/images/registerImage.png" alt="Signup illustration" class="w-full rounded-2xl">
    </div>
    <div class="max-w-md mx-auto w-full">
        <h1 class="text-4xl font-bold text-center mb-8">Signup</h1>

        <div class="flex gap-8 mb-8 border-b border-gray-200">
            <button class="pb-2 border-b-2 border-purple-700 text-purple-700 font-medium">Recruteur</button>
        </div>

        <form class="space-y-4" id="formRecruteur" name="formRecruteur" action="{{ route('register.recruteur') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">First Name</label>
                    <input type="text" placeholder="First Name" id="firstName" name="firstName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Last Name</label>
                    <input type="text" placeholder="Last Name" id="lastName" name="lastName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Business Email Address</label>
                <input type="email" placeholder="Business Email Address" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" placeholder="Password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
            </div>

            <button type="submit" class="w-full py-3 bg-purple-700 text-white rounded-lg font-medium hover:bg-purple-800 transition-colors mt-6">Signup</button>

            <p class="text-center text-sm text-gray-600 mt-4">
                Already have an account? <a href="{{ route('show.login') }}" class="text-blue-600 hover:underline">Login</a>
            </p>
        </form>
    </div>
@endsection

