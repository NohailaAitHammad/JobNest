@extends('layouts.app')
@section('content')

    <div class="max-w-7xl mx-auto px-8 pt-12 mb-8 flex flex-row justify-between items-center">
        <div class="flex items-center gap-5">
            <div class="relative">
                <img src="{{ Auth::user()->profileRecruteur && Auth::user()->profileRecruteur->imageURL ? asset('storage/' . Auth::user()->profileRecruteur->imageURL) : 'https://ui-avatars.com/api/?name='.Auth::user()->firstName . '&background=6b21a8&color=fff' }}"
                     class="w-20 h-20 rounded-2xl object-cover border-2 border-purple-200 shadow-sm" alt="">
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-purple-900">
                    Hello, {{ $user->firstName }} ! <span class="text-purple-500"></span>
                </h1>
                <p class="text-gray-500 font-medium">
                    Welcome back to your recruiter dashboard.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-purple-50 px-4 py-2 rounded-full border border-purple-100">
            <a href="{{ route('recruteurs.show') }}" class="p-2 bg-white rounded-full text-purple-700 hover:bg-purple-700 hover:text-white transition-all shadow-sm">
                <i class="fas fa-cog"></i>
            </a>
        </div>
    </div>

    <div class="page-header-bg text-white py-12 px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">{{ $stats['total_propositions_sent'] }}</div>
                    <div class="text-sm text-purple-600">Total Sent</div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">{{ $stats['pending'] }}</div>
                    <div class="text-sm text-purple-600">Pending</div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">{{ $stats['accepted'] }}</div>
                    <div class="text-sm text-purple-600">Accepted</div>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">{{ $stats['rejected'] }}</div>
                    <div class="text-sm text-purple-600">Rejected</div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-8 py-12 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-purple-800">Recent Proposals Sent</h2>
            <a href="{{ route('recruteurs.propositions') }}" class="text-sm text-purple-700 hover:underline flex items-center gap-1">
                See more <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="space-y-4">
            @forelse($propositions as $prop)
                <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center text-purple-700 font-bold">
                            {{ substr($prop->candidat->firstName, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-1">{{ $prop->titre }}</h3>
                            <p class="text-gray-600 text-sm mb-2">Candidate: {{ $prop->candidat->firstName }} {{ $prop->candidat->lastName }}</p>
                            <p class="text-gray-500 text-sm mb-3">{{ $prop->created_at->format('M d, Y') }}</p>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full {{ $prop->status->value === 'pending' ? 'bg-blue-500' : ($prop->status->value === 'accepter' ? 'bg-green-500' : 'bg-red-500') }}"></span>
                                <span class="font-medium text-sm {{ $prop->status->value === 'pending' ? 'text-blue-600' : ($prop->status->value === 'accepter' ? 'text-green-600' : 'text-red-600') }}">
                                    {{ ucfirst($prop->status->value) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('recruteur.propositions.show', $prop) }}" class="px-6 py-2 bg-purple-700 text-white rounded-full text-sm hover:bg-purple-800 transition-colors">
                        View Details
                    </a>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border-2 border-dashed border-purple-200">
                    <i class="fas fa-paper-plane text-purple-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">No proposals sent yet.</p>
                </div>
            @endforelse
                <div class="mt-8">
                    {{ $propositions->links() }}
                </div>
        </div>
    </div>
@endsection
