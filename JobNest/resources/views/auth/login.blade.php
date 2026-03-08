<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JobNest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen overflow-x-hidden">
<!-- Logo décoratif en haut à droite -->
<div class="absolute top-0 right-0 -mr-20 -mt-20">
    <div class="w-64 h-64 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center opacity-90">
        <span class="text-white text-8xl font-bold">J</span>
    </div>
</div>

<div class="container mx-auto px-4 py-8 min-h-screen flex items-center justify-center">
    <div class="grid lg:grid-cols-2 gap-12 items-center max-w-6xl w-full">
        <!-- Illustration côté gauche -->
        <div class="hidden lg:flex justify-center">
            <img src="assets/images/loginImage.png" alt="Illustration de recrutement - personne avec téléphone devant un écran montrant une offre d'emploi" class="w-full max-w-md">
        </div>

        <!-- Formulaire côté droit -->
        <div class="w-full max-w-md mx-auto">
            <h1 class="text-4xl font-bold text-gray-900 text-center mb-8">Login</h1>

            <!-- Formulaire de connexion -->
            <form id="loginForm" class="space-y-6" action="{{ route('login') }}" method="POST" >
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        required
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
                        id="password"
                        placeholder="Password"
                        name="password"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    @error('password')
                    <span class="text-red-600 p-4 " >{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <span class="text-sm text-gray-700">Remember Me</span>
                    </label>
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-semibold">
                        Forget Password?
                    </a>
                </div>

                <!-- Bouton Login -->
                <button
                    type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition duration-200"
                >
                    Login
                </button>
            </form>

            <!-- Lien Sign Up -->
            <p class="text-center text-gray-600 mt-6">
                Don't have an account?
                <a href="{{ route('register.condidat') }}" class="text-purple-600 hover:text-purple-700 font-semibold">Sign Up as Condidat</a>
            </p>
            <p class="text-center text-gray-600 mt-6">
                Don't have an account?
                <a href="{{ route('register.recruter') }}" class="text-purple-600 hover:text-purple-700 font-semibold">Sign Up as Recruter</a>
            </p>
        </div>
    </div>
</div>

<script>
</script>
</body>
</html>
