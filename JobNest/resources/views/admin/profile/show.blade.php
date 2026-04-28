@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-purple-700 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-purple-800">User Details</h1>
            </div>
            <div class="flex gap-3">
                <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="px-6 py-2 bg-white border border-purple-700 text-purple-700 rounded-xl font-medium hover:bg-purple-50 transition-all">
                        {{ $user->status->value === 'active' ? 'Ban User' : 'Unban User' }}
                    </button>
                </form>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user permanently?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-6 py-2 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-all">
                        Delete User
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card Info Basique -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-purple-100 h-fit">
                <div class="flex flex-col items-center text-center">
                    <img src="{{ $user->profileCandidat && $user->profileCandidat->imageURL ? asset('storage/' . $user->profileCandidat->imageURL) : ($user->profileRecruteur && $user->profileRecruteur->imageURL ? asset('storage/' . $user->profileRecruteur->imageURL) : 'https://ui-avatars.com/api/?name='. $user->firstName) }}"
                         class="w-32 h-32 rounded-full object-cover mb-6 border-4 border-purple-100">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->firstName }} {{ $user->lastName }}</h2>
                    <p class="text-purple-600 font-medium mb-4">{{ $user->role->role }}</p>

                    <div class="w-full space-y-3 border-t pt-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Email:</span>
                            <span class="font-medium">{{ $user->email }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Status:</span>
                            <span class="font-bold {{ $user->status->value === 'active' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($user->status->value) }}
                        </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Détails Spécifiques -->
            <div class="md:col-span-2 space-y-6">
                @if($user->role->role === 'candidat')
                    <!-- Infos Candidat -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-purple-100">
                        <h3 class="text-xl font-bold text-purple-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-user-graduate"></i> Talent Profile
                        </h3>
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div><label class="text-xs text-gray-400 uppercase font-bold">City</label><p class="font-medium">{{ $user->profileCandidat->ville ?? 'N/A' }}</p></div>
                            <div><label class="text-xs text-gray-400 uppercase font-bold">Phone</label><p class="font-medium">{{ $user->profileCandidat->telephone ?? 'N/A' }}</p></div>
                        </div>

                        <h4 class="font-bold text-sm text-gray-700 mb-3">Top Skills</h4>
                        <div class="flex flex-wrap gap-2 mb-8">
                            @foreach($user->profileCandidat->competences as $comp)
                                <span class="px-3 py-1 bg-purple-50 text-purple-700 rounded-full text-xs border border-purple-100">{{ $comp->libelle }}</span>
                            @endforeach
                        </div>

                        <h4 class="font-bold text-sm text-gray-700 mb-3">Experience History</h4>
                        <div class="space-y-3">
                            @foreach($user->profileCandidat->experiences as $exp)
                                <div class="p-3 bg-gray-50 rounded-lg text-sm border-l-4 border-purple-400">
                                    <span class="font-bold">{{ $exp->poste }}</span> at {{ $exp->entreprise }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                @elseif($user->role->role === 'recruteur')
                    <!-- Infos Recruteur -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-purple-100">
                        <h3 class="text-xl font-bold text-purple-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-building"></i> Company Profile
                        </h3>
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $user->profileRecruteur->entreprise->nom ?? 'No Company' }}</h2>
                            <p class="text-gray-500">{{ $user->profileRecruteur->entreprise->description ?? 'No description provided.' }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <div><label class="text-xs text-gray-400 uppercase font-bold">Employees</label><p class="font-medium">{{ $user->profileRecruteur->entreprise->nombreEmployees ?? '0' }}</p></div>
                            <div><label class="text-xs text-gray-400 uppercase font-bold">Location</label><p class="font-medium">{{ $user->profileRecruteur->entreprise->ville ?? 'N/A' }}</p></div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($user->profileRecruteur->entreprise->domaines as $dom)
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">{{ $dom->nomDomaine }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
