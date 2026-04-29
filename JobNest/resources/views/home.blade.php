@extends("layouts.guestLayout")
@section('content')
    <!-- Hero Section -->
    <section class="px-8 py-16 max-w-7xl mx-auto grid grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="text-5xl font-bold leading-tight mb-6">Because Your <span class="text-purple-700">Talent</span><br>Deserves to Be <span class="text-purple-700">Seen</span>.</h1>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">JobNest reimagines recruitment by shifting the focus to candidates. Create your professional profile, highlight your strengths, and let companies reach out to you.</p>
            @guest()
                <div class="flex gap-4">
                    <a href="{{ route('register.show.recruteur') }}" class="px-8 py-3 border border-purple-700 text-purple-700 rounded-lg font-medium hover:bg-purple-50 transition-colors">Hire Talent</a>
                    <a href="{{ route('register.show.candidat') }}" class="px-8 py-3 border border-purple-700 text-purple-700 rounded-lg font-medium hover:bg-purple-50 transition-colors">Find a Job</a>
                </div>
            @endguest

        </div>
        <div class="relative">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&auto=format&fit=crop" alt="Team collaboration" class="rounded-2xl shadow-2xl">
            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-purple-100 rounded-full opacity-50"></div>
        </div>
    </section>

    <!-- Achievement Section -->
    <section class="px-8 py-16 max-w-7xl mx-auto">
        <div class="inline-block px-4 py-2 bg-purple-700 text-white rounded mb-8">Our Achievement</div>
        <div class="relative bg-gray-900 rounded-2xl overflow-hidden h-80 flex items-center justify-center mb-12">
            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=1200&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40" alt="Office">
            <div class="relative text-center text-white">
                <div class="text-6xl font-bold mb-2">1000+</div>
                <div class="text-xl">Jobs posted</div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-8 text-center bg-gray-50 py-12 rounded-2xl">
            <div>
                <div class="text-4xl font-bold text-gray-900 mb-2">1,200+</div>
                <div class="text-gray-600">Registered Candidates</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-gray-900 mb-2">150+</div>
                <div class="text-gray-600">Partner Companies</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-gray-900 mb-2">85%</div>
                <div class="text-gray-600">Satisfaction Rate</div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="px-8 py-16 max-w-7xl mx-auto grid grid-cols-2 gap-12 items-center">
        <div class="bg-blue-50 rounded-2xl p-8 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=600&auto=format&fit=crop" class="w-full rounded-lg" alt="Working">
        </div>
        <div>
            <div class="inline-block px-4 py-2 bg-purple-700 text-white rounded mb-8">How It Works</div>
            <div class="space-y-8">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 flex-shrink-0">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Create Your Account</h3>
                        <p class="text-gray-600 text-sm">Sign up in seconds and select your role: candidate or recruiter.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 flex-shrink-0">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Showcase Your Talent</h3>
                        <p class="text-gray-600 text-sm">Build a strong profile by highlighting your skills and experience.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 flex-shrink-0">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Get Matched</h3>
                        <p class="text-gray-600 text-sm">Send or receive opportunities and find the perfect match quickly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="px-8 py-16 max-w-7xl mx-auto">
        <div class="inline-block px-4 py-2 bg-purple-700 text-white rounded mb-8">Why Choose Us?</div>
        <div class="grid grid-cols-2 gap-6">
            <div class="border border-purple-200 rounded-xl p-6 card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-user-tie text-purple-700 text-xl"></i>
                    <h3 class="font-bold">Talent-First Approach</h3>
                </div>
                <p class="text-gray-600 text-sm">We put candidates at the center of the hiring process, giving visibility to real skills and experience.</p>
            </div>
            <div class="border border-purple-200 rounded-xl p-6 card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-clock text-purple-700 text-xl"></i>
                    <h3 class="font-bold">Faster Hiring Process</h3>
                </div>
                <p class="text-gray-600 text-sm">Save time with direct and meaningful connections between candidates and recruiters.</p>
            </div>
            <div class="border border-purple-200 rounded-xl p-6 card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-exchange-alt text-purple-700 text-xl"></i>
                    <h3 class="font-bold">Reverse Recruitment</h3>
                </div>
                <p class="text-gray-600 text-sm">Companies reach out to you – no more endless job applications.</p>
            </div>
            <div class="border border-purple-200 rounded-xl p-6 card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-id-card text-purple-700 text-xl"></i>
                    <h3 class="font-bold">Professional Profiles</h3>
                </div>
                <p class="text-gray-600 text-sm">Showcase your skills, experience, and strengths in a clean and structured way.</p>
            </div>
            <div class="border border-purple-200 rounded-xl p-6 card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-brain text-purple-700 text-xl"></i>
                    <h3 class="font-bold">Smart Matching</h3>
                </div>
                <p class="text-gray-600 text-sm">Our system connects the right talent with the right opportunities efficiently.</p>
            </div>
            <div class="border border-purple-200 rounded-xl p-6 card-hover">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-globe text-purple-700 text-xl"></i>
                    <h3 class="font-bold">Trusted Network</h3>
                </div>
                <p class="text-gray-600 text-sm">Join a growing community of verified candidates and partner companies.</p>
            </div>
        </div>
    </section>
@endsection

