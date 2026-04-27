@extends('layouts.app')
@section('content')
    <!-- Hero Section with Stats -->
    <div class="page-header-bg text-white py-12 px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-eye"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">20</div>
                    <div class="text-sm text-purple-600">Profile Views</div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">5</div>
                    <div class="text-sm text-purple-600">Proposals Received</div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">2</div>
                    <div class="text-sm text-purple-600">Pending</div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">4</div>
                    <div class="text-sm text-purple-600">Accepted</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Proposals -->
    <div class="px-8 py-12 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-purple-800">Recent Proposals</h2>
            <a href="my-propositions.html" class="text-sm text-purple-700 hover:underline flex items-center gap-1">See more <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="space-y-4">
            <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center card-hover">
                <div>
                    <h3 class="text-xl font-bold mb-1">UI/UX Designer for Mobile App</h3>
                    <p class="text-gray-600 text-sm mb-2">BoldTech Inc.</p>
                    <p class="text-gray-500 text-sm mb-3">March 15, 2025</p>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                        <span class="status-pending font-medium text-sm">Pending</span>
                    </div>
                </div>
                <a href="my-propositions.html" class="px-6 py-2 bg-purple-700 text-white rounded-full text-sm hover:bg-purple-800 transition-colors">View Details</a>
            </div>

            <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center card-hover">
                <div>
                    <h3 class="text-xl font-bold mb-1">Graphic Designer for Marketing Campaign</h3>
                    <p class="text-gray-600 text-sm mb-2">Creative Minds Co.</p>
                    <p class="text-gray-500 text-sm mb-3">April 5, 2025</p>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="status-accepted font-medium text-sm">Accepted</span>
                    </div>
                </div>
                <a href="my-propositions.html" class="px-6 py-2 bg-purple-700 text-white rounded-full text-sm hover:bg-purple-800 transition-colors">View Details</a>
            </div>

            <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center card-hover">
                <div>
                    <h3 class="text-xl font-bold mb-1">Frontend Developer for Fintech App</h3>
                    <p class="text-gray-600 text-sm mb-2">FinanceHub Inc.</p>
                    <p class="text-gray-500 text-sm mb-3">April 15, 2025</p>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="status-accepted font-medium text-sm">Accepted</span>
                    </div>
                </div>
                <a href="my-propositions.html" class="px-6 py-2 bg-purple-700 text-white rounded-full text-sm hover:bg-purple-800 transition-colors">View Details</a>
            </div>

            <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center card-hover">
                <div>
                    <h3 class="text-xl font-bold mb-1">Data Analyst for Retail Analytics</h3>
                    <p class="text-gray-600 text-sm mb-2">Insightful Data Corp.</p>
                    <p class="text-gray-500 text-sm mb-3">March 30, 2025</p>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        <span class="status-rejected font-medium text-sm">Rejected</span>
                    </div>
                </div>
                <a href="my-propositions.html" class="px-6 py-2 bg-purple-700 text-white rounded-full text-sm hover:bg-purple-800 transition-colors">View Details</a>
            </div>
        </div>
    </div>
@endsection
