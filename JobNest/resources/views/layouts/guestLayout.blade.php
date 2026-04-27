<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobNest - Because Your Talent Deserves to Be Seen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-900">

@include('layouts.NavBar')

@yield('content')

<!-- Footer -->
<footer class="bg-purple-900 text-white py-12 px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-4 gap-8">
        <div>
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-purple-900 font-bold text-2xl mb-4">J</div>
            <p class="text-sm text-purple-200 mb-2">Copyright © 2025 J</p>
            <p class="text-sm text-purple-200">All rights reserved</p>
        </div>
        <div>
            <h4 class="font-bold mb-4">Company</h4>
            <ul class="space-y-2 text-sm text-purple-200">
                <li><a href="#" class="hover:text-white transition-colors">About us</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Services</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Contact us</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold mb-4">Support</h4>
            <ul class="space-y-2 text-sm text-purple-200">
                <li><a href="#" class="hover:text-white transition-colors">Help center</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Terms of service</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Legal</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Privacy policy</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Status</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-bold mb-4">Legal</h4>
            <ul class="space-y-2 text-sm text-purple-200">
                <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
            </ul>
            <div class="flex gap-4 mt-4">
                <a href="#" class="w-8 h-8 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700 transition-colors"><i class="fab fa-instagram"></i></a>
                <a href="#" class="w-8 h-8 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700 transition-colors"><i class="fab fa-youtube"></i></a>
                <a href="#" class="w-8 h-8 bg-purple-800 rounded-full flex items-center justify-center hover:bg-purple-700 transition-colors"><i class="fab fa-x-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
