@extends('layouts.app')
@section('content')


    <div class="max-w-7xl mx-auto px-8 pt-12 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-3xl shadow-sm border border-purple-50">

            <div class="flex items-center gap-5">

                <div class="relative">
                    <img src="{{ Auth::user()->profileCandidat && Auth::user()->profileCandidat->imageURL ? asset('storage/' . Auth::user()->profileCandidat->imageURL) : 'https://ui-avatars.com/api/?name='.Auth::user()->firstName . '&background=6b21a8&color=fff' }}"
                         class="w-20 h-20 rounded-2xl object-cover border-2 border-purple-200 shadow-sm">
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></div>
                </div>

                <div>
                    <h1 class="text-3xl font-extrabold text-purple-900">
                        Hello, {{ $user->firstName }} ! <span class="text-purple-500"></span>
                    </h1>
                    <p class="text-gray-500 font-medium">
                        Welcome back to your talent dashboard.
                        <span class="hidden md:inline text-gray-400">|</span>
                        <span class="hidden md:inline text-gray-400">Today is {{ date('d M Y') }}</span>
                    </p>
                </div>
            </div>


            <div class="flex items-center gap-3 bg-purple-50 px-4 py-2 rounded-full border border-purple-100">
                <div class="flex flex-col items-end">
                    <span class="text-[10px] uppercase font-bold text-purple-400 tracking-wider">Profile Status</span>
                    <span class="text-sm font-bold {{ $profileCandidat->est_visible ? 'text-green-600' : 'text-orange-500' }}">
                    {{ $profileCandidat->est_visible ? 'Visible to Recruiters' : 'Hidden' }}
                </span>
                </div>
                <a href="{{ route('candidat.show') }}" class="p-2 bg-white rounded-full text-purple-700 hover:bg-purple-700 hover:text-white transition-all shadow-sm">
                    <i class="fas fa-cog"></i>
                </a>
            </div>

        </div>
    </div>



    <div class="page-header-bg text-white py-12 px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">


            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div
                    class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-eye"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">{{ $user->vues->count() }}</div>
                    <div class="text-sm text-purple-600">Profile Views</div>
                </div>
            </div>


            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div
                    class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">{{ $propositions->count() }}</div>
                    <div class="text-sm text-purple-600">Proposals Received</div>
                </div>
            </div>


            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div
                    class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">
                        {{ $propositions->where('status', 'pending')->count() }}
                    </div>
                    <div class="text-sm text-purple-600">Pending</div>
                </div>
            </div>


            <div class="glass-card rounded-2xl p-6 text-gray-800 flex items-center gap-4 card-hover">
                <div
                    class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-xl">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-800">
                        {{ $propositions->where('status', 'accepter')->count() }}
                    </div>
                    <div class="text-sm text-purple-600">Accepted</div>
                </div>
            </div>
        </div>
    </div>


    <div class="px-8 py-12 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-purple-800">Recent Proposals</h2>
            <a href="{{ route('candidats.propositions.index') }}"
               class="text-sm text-purple-700 hover:underline flex items-center gap-1">
                See more <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="space-y-4">
            @forelse($propositions as $prop)
                <div class="bg-purple-50 rounded-2xl p-6 flex justify-between items-center card-hover">
                    <div class="flex gap-4 items-center">
                        <div
                            class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center text-purple-700 font-bold">
                            {{ substr($prop->recruteur->firstName, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-1">{{ $prop->titre }}</h3>
                            <p class="text-gray-600 text-sm mb-2">
                                <i class="fas fa-building mr-1"></i> {{ $prop->recruteur->profileRecruteur->entreprise->nom ?? 'Recruteur' }}
                            </p>
                            <p class="text-gray-500 text-sm mb-3">
                                {{ $prop->created_at->format('M d, Y') }}
                            </p>
                            <div class="flex items-center gap-2">
                                @if($prop->status->value === 'pending')
                                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                    <span class="text-blue-600 font-medium text-sm">Pending</span>
                                @elseif($prop->status->value === 'accepter')
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="text-green-600 font-medium text-sm">Accepted</span>
                                @else
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                    <span class="text-red-600 font-medium text-sm">Rejected</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('candidats.propositions.show', $prop->id) }}"
                       class="px-6 py-2 bg-purple-700 text-white rounded-full text-sm hover:bg-purple-800 transition-colors">
                        View Details
                    </a>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border-2 border-dashed border-purple-200">
                    <i class="fas fa-envelope-open text-purple-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">No proposals received yet. Complete your profile to attract recruiters!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
