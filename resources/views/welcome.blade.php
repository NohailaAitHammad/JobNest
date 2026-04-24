<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproduction Design - JobPlatform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        purpleBrand: '#8A2BE2',
                        darkPurple: '#6A0DAD',
                        lightBg: '#F9F5FF',
                        grayText: '#667085'
                    }
                }
            }
        }
    </script>
    <style>
        .purple-gradient-footer {
            background: linear-gradient(135deg, #6A0DAD 0%, #4B0082 100%);
        }
    </style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden">

<nav class="flex justify-between items-center px-6 py-4 max-w-7xl mx-auto">
    <div class="text-purpleBrand text-3xl font-bold">J</div>
    <div class="relative flex-1 max-w-md mx-8 hidden md:block">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="fas fa-search text-sm"></i>
            </span>
        <input type="text" placeholder="Search" class="w-full bg-gray-100 rounded-lg py-1 pl-10 pr-4 focus:outline-none text-sm">
    </div>
    <div class="flex gap-4">
        <button class="text-purpleBrand border border-purpleBrand px-4 py-1.5 rounded-md text-sm font-medium">Post Career Talent</button>
        <button class="bg-purpleBrand text-white px-4 py-1.5 rounded-md text-sm font-medium shadow-md">Project or Help</button>
    </div>
</nav>

<header class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row items-center gap-10">
    <div class="w-full md:w-1/2">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            Connecting <span class="text-purpleBrand">You</span> to <br> the World's <span class="text-purpleBrand">Best Tech Talent.</span>
        </h1>
        <p class="text-grayText mt-6 max-w-md">
            Discover, hire, and manage top talent for your projects of any size. The full-hiring module designed for your success.
        </p>
        <div class="mt-8 flex gap-4">
            <a href="{{ route('register.condidat') }}" class="border border-gray-300 px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-50">I am a talent</a>
            <a  href="{{ route('register.recruter') }}"   class="border border-gray-300 px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-50">I am a Hire</a>
        </div>
    </div>
    <div class="w-full md:w-1/2 flex justify-center">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/1.svg" class="w-72 md:w-96" alt="Hero Illustration">
    </div>
</header>

<section class="py-12 text-center">
    <span class="bg-purpleBrand text-white px-4 py-1 text-xs font-bold uppercase mb-8 inline-block">Our Achievement</span>

    <div class="relative flex justify-center items-center gap-4 mt-8 px-4 overflow-hidden">
        <div class="hidden md:block w-64 h-48 bg-gray-100 rounded-xl opacity-50 transform -translate-x-10 scale-90"></div>
        <div class="w-full max-w-md bg-white border border-gray-200 shadow-2xl rounded-2xl p-8 z-10 relative">
            <h3 class="text-4xl font-bold text-gray-800">1000+</h3>
            <p class="text-purpleBrand font-semibold">Jobs posted</p>
            <p class="text-xs text-gray-400 mt-2">Connecting talent to opportunities daily</p>
        </div>
        <div class="hidden md:block w-64 h-48 bg-gray-100 rounded-xl opacity-50 transform translate-x-10 scale-90"></div>
    </div>

    <div class="flex justify-center items-center gap-4 mt-6">
        <button class="text-gray-400 hover:text-purpleBrand"><i class="fas fa-arrow-left"></i></button>
        <div class="flex gap-1">
            <div class="w-2 h-2 rounded-full bg-purpleBrand"></div>
            <div class="w-2 h-2 rounded-full bg-gray-200"></div>
            <div class="w-2 h-2 rounded-full bg-gray-200"></div>
        </div>
        <button class="text-gray-400 hover:text-purpleBrand"><i class="fas fa-arrow-right"></i></button>
    </div>

    <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-5 gap-4 mt-16 px-6 py-8 border-t border-b border-gray-100">
        <div><p class="text-xl font-bold">1,200+</p><p class="text-xs text-grayText">Companies</p></div>
        <div><p class="text-xl font-bold">5,000+</p><p class="text-xs text-grayText">Talents</p></div>
        <div><p class="text-xl font-bold">24/7</p><p class="text-xs text-grayText">Support Agent</p></div>
        <div><p class="text-xl font-bold">15,000+</p><p class="text-xs text-grayText">Applicants</p></div>
        <div><p class="text-xl font-bold">65%</p><p class="text-xs text-grayText">Retention</p></div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20">
    <span class="bg-purpleBrand text-white px-4 py-1 text-xs font-bold uppercase mb-12 inline-block">How It Works</span>
    <div class="flex flex-col md:flex-row items-center gap-16">
        <div class="w-full md:w-1/2">
            <img src="https://img.freepik.com/free-vector/job-interview-concept-illustration_114360-3162.jpg" alt="How it works" class="rounded-xl">
        </div>
        <div class="w-full md:w-1/2 space-y-8">
            <div class="flex gap-4">
                <div class="bg-purpleBrand text-white w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"><i class="fas fa-user-plus text-xs"></i></div>
                <div><h4 class="font-bold">Create an Account</h4><p class="text-sm text-grayText">Sign up to get started as an employer or talent.</p></div>
            </div>
            <div class="flex gap-4">
                <div class="bg-purpleBrand text-white w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"><i class="fas fa-search text-xs"></i></div>
                <div><h4 class="font-bold">Explore & Post Opportunities</h4><p class="text-sm text-grayText">Find the best roles or the best candidates.</p></div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20 border-t border-gray-100">
    <span class="bg-purpleBrand text-white px-4 py-1 text-xs font-bold uppercase mb-12 inline-block">Why Choose Us?</span>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 mt-8">
        <div class="border-b border-gray-100 pb-4 flex items-start gap-4">
            <i class="fas fa-search text-purpleBrand mt-1"></i>
            <div><h4 class="font-bold">Curated Job Matches</h4><p class="text-xs text-grayText">Algorithm based matching for perfect fit.</p></div>
        </div>
        <div class="border-b border-gray-100 pb-4 flex items-start gap-4">
            <i class="fas fa-bolt text-purpleBrand mt-1"></i>
            <div><h4 class="font-bold">Fast & Transparent Hiring</h4><p class="text-xs text-grayText">Quick responses and clear communication.</p></div>
        </div>
        <div class="border-b border-gray-100 pb-4 flex items-start gap-4">
            <i class="fas fa-check-circle text-purpleBrand mt-1"></i>
            <div><h4 class="font-bold">Verified Employers & Talent</h4><p class="text-xs text-grayText">Safety first with our verification system.</p></div>
        </div>
        <div class="border-b border-gray-100 pb-4 flex items-start gap-4">
            <i class="fas fa-briefcase text-purpleBrand mt-1"></i>
            <div><h4 class="font-bold">Built for Every Career Stage</h4><p class="text-xs text-grayText">From juniors to seasoned experts.</p></div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20">
    <span class="bg-purpleBrand text-white px-4 py-1 text-xs font-bold uppercase mb-12 inline-block">Testimonials</span>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
        <div class="bg-gray-100 p-6 rounded-xl">
            <div class="w-10 h-10 bg-gray-300 rounded-full mb-4"></div>
            <p class="text-xs text-gray-600 italic">"This platform is amazing for developers."</p>
            <p class="text-[10px] font-bold mt-4">John Doe, Engineer</p>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20">
    <span class="bg-purpleBrand text-white px-4 py-1 text-xs font-bold uppercase mb-12 inline-block">Articles</span>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
        <div class="group">
            <div class="h-48 bg-gray-200 rounded-xl overflow-hidden mb-4">
                <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=500&auto=format&fit=crop&q=60" class="w-full h-full object-cover">
            </div>
            <p class="text-purpleBrand text-[10px] font-bold uppercase">Career Advice</p>
            <h4 class="font-bold text-sm mt-1">How to Craft a Winning Resume</h4>
            <p class="text-gray-400 text-[10px] mt-2">Jan 12, 2024 • 5 min read</p>
        </div>
    </div>
</section>

<footer class="purple-gradient-footer text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-white/10 pb-12">
        <div>
            <div class="text-3xl font-bold mb-6">J</div>
            <p class="text-sm opacity-70">Empowering the world through tech talent connections.</p>
        </div>
        <div>
            <h5 class="font-bold mb-4">Company</h5>
            <ul class="text-sm opacity-70 space-y-2">
                <li>About Us</li>
                <li>Careers</li>
            </ul>
        </div>
        <div>
            <h5 class="font-bold mb-4">Support</h5>
            <ul class="text-sm opacity-70 space-y-2">
                <li>Contact Us</li>
                <li>FAQ</li>
            </ul>
        </div>
        <div class="flex gap-4">
            <i class="fab fa-twitter"></i>
            <i class="fab fa-linkedin"></i>
            <i class="fab fa-instagram"></i>
        </div>
    </div>
    <div class="text-center mt-10 text-[10px] opacity-50">
        &copy; 2024 JobConnect. All rights reserved.
    </div>
</footer>

</body>
</html>
