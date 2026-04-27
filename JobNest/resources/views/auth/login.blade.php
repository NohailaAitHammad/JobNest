@extends('layouts.authLayout')
@section('content')
    <div class="hidden lg:block">
        <img src="assets/images/loginImage.png" alt="Login illustration" class="w-full rounded-2xl">
    </div>
    <div class="max-w-md mx-auto w-full">
        <h1 class="text-4xl font-bold text-center mb-8">Login</h1>

        <form class="space-y-6" name="formLogin" id="formLogin" action="{{route('login')}}" method="POST">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" placeholder="Email" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" placeholder="Password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
            </div>
            <button type="submit" class="w-full py-3 bg-purple-700 text-white rounded-lg font-medium hover:bg-purple-800 transition-colors">Login</button>

            <p class="text-center text-sm text-gray-600 mt-4">
                Don't have a Candidat account ? <a href="{{ route('register.show.candidat') }}" class="text-blue-600 hover:underline">Sign Up</a>
            </p>

            <p class="text-center text-sm text-gray-600 mt-4">
                Don't have a Recruteur account ? <a href="{{route('register.show.recruteur')}}" class="text-blue-600 hover:underline">Sign Up</a>
            </p>
        </form>
    </div>
@endsection

