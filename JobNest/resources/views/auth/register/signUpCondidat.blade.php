<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - JobNest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen  overflow-x-hidden ">
<!-- Logo en haut à droite -->
<div class="absolute top-0 right-0 -mr-20 -mt-20">
    <div class="w-64 h-64 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center opacity-90">
        <span class="text-white text-8xl font-bold">J</span>
    </div>
</div>

<div class="container mx-auto px-4 py-8 min-h-screen flex items-center justify-center">
    <div class="grid lg:grid-cols-2 gap-12 items-center max-w-6xl w-full">
        <!-- Illustration côté gauche -->
        <div class="hidden lg:flex justify-center">
            <img src="../assets/images/registerImage.png" alt="Signup Illustration" class="w-full max-w-md">
        </div>

        <!-- Formulaire côté droit -->
        <div class="w-full max-w-md mx-auto">
            <h1 class="text-4xl font-bold text-gray-900 text-center mb-8">Signup</h1>

            <!-- Formulaire -->
            <form class="space-y-5" action="{{ route('store.condidat') }}" method="POST">
                @csrf
                <!-- FirstName -->
                <div>
                    <label for="fistName" class="block text-sm font-semibold text-gray-900 mb-2">
                        FirstName
                    </label>
                    <input
                        type="text"
                        name="firstName"
                        id="fistName"
                        placeholder="fistName"
                        value="{{ old('firstName') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    @error('firstName')
                    <span class="text-red-600 p-4 " >{{ $message }}</span>
                    @enderror

                </div>

                <!-- LastName -->
                <div>
                    <label for="lastName" class="block text-sm font-semibold text-gray-900 mb-2">
                        LastName
                    </label>
                    <input
                        type="text"
                        placeholder="lastName"
                        name="lastName"
                        id="lastName"
                        value="{{ old('lastName') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    @error('lastName')
                    <span class="text-red-600 p-4 " >{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        placeholder="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    @error('email')
                    <span class="text-red-600 p-4 " >{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        placeholder="Password"
                        name="password"
                        id="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    @error('password')
                    <span class="text-red-600 p-4 " >{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        placeholder="Confirm Password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                </div>

                <!-- Bouton Signup -->
                <button
                    type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition duration-200 mt-6"
                >
                    Signup
                </button>
            </form>

            <!-- Lien Login -->
            <p class="text-center text-gray-600 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-semibold">Login</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
