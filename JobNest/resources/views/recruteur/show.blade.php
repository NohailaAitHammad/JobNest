@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Left Column -->
                <div class="p-12 border-r border-gray-200">
                    <div class="flex flex-col items-center text-center mb-8">
                        <img src="{{ $profileRecruteur->imageURL ? asset('storage/' . $profileRecruteur->imageURL) : 'https://ui-avatars.com/api/?name='. $user->firstName }}"
                             class="w-48 h-48 rounded-full object-cover mb-6 border-4 border-purple-100" alt="">
                        <h1 class="text-3xl font-bold mb-2">{{ $user->firstName }} {{ $user->lastName }}</h1>
                        <p class="text-purple-700 text-xl mb-6">{{ $profileRecruteur->poste }}</p>
                        <a href="{{ route('recruteurs.edit') }}" class="px-8 py-3 bg-purple-700 text-white rounded-full font-medium hover:bg-purple-800 transition-colors">
                            Modifier mon profil
                        </a>
                    </div>
                    <div class="space-y-4 text-left max-w-sm mx-auto">
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="fas fa-map-marker-alt text-purple-600 w-5"></i> <span>{{ $profileRecruteur->ville }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="far fa-envelope text-purple-600 w-5"></i> <span>{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="fas fa-phone text-purple-600 w-5"></i> <span>{{ $profileRecruteur->telephone }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="p-12">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4">Entreprise</h2>
                        <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100">
                            <h3 class="text-2xl font-bold text-purple-800 mb-2">{{ $profileRecruteur->entreprise->nom ?? 'N/A' }}</h3>
                            <p class="text-gray-600 mb-4">{{ $profileRecruteur->entreprise->description ?? 'Aucune description' }}</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($profileRecruteur->entreprise->domaines as $domaine)
                                    <span class="px-3 py-1 bg-white rounded-full text-xs font-bold text-purple-700 border border-purple-200">
                                    {{ $domaine->nomDomaine }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="text-xs text-gray-500 block">Employees</label>
                            <p class="font-bold">{{ $profileRecruteur->entreprise->nombreEmployees ?? '0' }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="text-xs text-gray-500 block">Founded</label>
                            <p class="font-bold">{{ $profileRecruteur->entreprise->dateCreation ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
