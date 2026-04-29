@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">

                <div class="p-12 border-r border-gray-200">
                    <div class="flex flex-col items-center text-center mb-8">

                        <img src="{{ $profile->imageURL ? asset('storage/' . $profile->imageURL) : 'https://ui-avatars.com/api/?name='. $user->firstName . ' ' . $user->lastName }}"
                             class="w-48 h-48 rounded-full object-cover mb-6 border-4 border-purple-100">

                        <h1 class="text-3xl font-bold mb-2">{{ $user->firstName }} {{ $user->lastName }}</h1>
                        <p class="text-purple-700 text-xl mb-6">Candidat</p>

                        <div class="flex flex-col gap-3">
                            <a href="{{ route('candidat.edit') }}" class="px-8 py-3 bg-purple-700 text-white rounded-full font-medium hover:bg-purple-800 transition-colors">
                                Modifier mon profil
                            </a>
                            <a href="{{ route('candidats.experiences.index') }}" class="px-8 py-3 bg-white border-2 border-purple-700 text-purple-700 rounded-full font-medium hover:bg-purple-50 transition-colors text-center">
                                Gérer mes expériences
                            </a>
                            <a href="{{ route('candidats.competences.index') }}" class="px-8 py-3 bg-white border-2 border-purple-700 text-purple-700 rounded-full font-medium hover:bg-purple-50 transition-colors text-center">
                                Gérer mes competences
                            </a>
                        </div>
                    </div>

                    <div class="space-y-4 text-left max-w-sm mx-auto">
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="fas fa-map-marker-alt text-purple-600 w-5"></i>
                            <span>{{ $profile->ville ?? 'Non renseigné' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="far fa-envelope text-purple-600 w-5"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="fas fa-phone text-purple-600 w-5"></i>
                            <span>{{ $profile->telephone ?? 'Non renseigné' }}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-8 justify-center">
                        @forelse($profile->competences as $comp)
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-sm">{{ $comp->libelle }} ({{ $comp->pivot->niveau }})</span>
                        @empty
                            <p class="text-gray-500 text-sm">Aucune compétence ajoutée.</p>
                        @endforelse
                    </div>
                </div>


                <div class="p-12">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4">Informations Générales</h2>
                        <div class="mb-4">
                            <label class="text-sm text-gray-500 block mb-1">Email</label>
                            <p class="font-medium">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Expériences Professionnelles</h2>
                            <a href="{{ route('candidats.experiences.index') }}" class="text-sm text-purple-600 hover:underline flex items-center gap-1">
                                Gérer tout <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($profile->experiences as $exp)
                                <div>
                                    <h3 class="font-bold text-sm">{{ $exp->poste }} – {{ $exp->entreprise }} ({{ $exp->dateDebut }} – {{ $exp->dateFin ?? 'Présent' }})</h3>
                                    <p class="text-gray-600 text-sm mt-1">{{ $exp->description }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">Aucune expérience ajoutée.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Certifications</h2>
                            <a href="{{ route('candidats.certifications.index') }}" class="text-sm text-purple-600 hover:underline flex items-center gap-1">
                                Gérer tout <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($profile->certifications as $cert)
                                <div>
                                    <h3 class="font-bold text-sm">{{ $cert->titre }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">{{ $cert->organisme }} - {{ $cert->dateObtention }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">Aucune certification ajoutée.</p>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold mb-4">Documents</h2>
                        <div class="space-y-3">
                            @if($profile->cv_url)
                                <a href="{{ asset('storage/' . $profile->cv_url) }}" target="_blank" class="flex items-center gap-2 text-blue-600 hover:underline">
                                    <i class="fas fa-download"></i>
                                    <span>Télécharger le CV (PDF)</span>
                                </a>
                            @endif
                            @if($profile->portfolio_url)
                                <a href="{{  asset('storage/' . $profile->portfolio_url) }}" target="_blank" class="flex items-center gap-2 text-blue-600 hover:underline">
                                    <i class="fas fa-external-link-alt"></i>
                                    <span>Voir le Portfolio</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
