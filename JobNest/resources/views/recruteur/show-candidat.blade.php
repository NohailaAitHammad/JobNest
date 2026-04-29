@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-purple-100">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-12 border-r border-gray-200">
                    <div class="flex flex-col items-center text-center mb-8">
                        <img src="{{ $profileCandidat->imageURL ? asset('storage/' . $profileCandidat->imageURL) : 'https://ui-avatars.com/api/?name='. $profileCandidat->user->firstName }}"
                             class="w-48 h-48 rounded-full object-cover mb-6 border-4 border-purple-100" alt="">
                        <h1 class="text-3xl font-bold mb-2">{{ $profileCandidat->user->firstName }} {{ $profileCandidat->user->lastName }}</h1>
                        <p class="text-purple-700 text-xl mb-6">Candidat Talent</p>

                        <a href="#proposal-form" class="px-8 py-3 bg-purple-700 text-white rounded-full font-medium hover:bg-purple-800 transition-colors shadow-lg shadow-purple-200">
                            <i class="fas fa-paper-plane mr-2"></i> Send a Proposal
                        </a>
                    </div>
                    <div class="space-y-4 text-left max-w-sm mx-auto">
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="fas fa-map-marker-alt text-purple-600 w-5"></i> <span>{{ $profileCandidat->ville }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <i class="far fa-envelope text-purple-600 w-5"></i> <span>{{ $profileCandidat->user->email }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-8 justify-center">
                        @foreach($profileCandidat->competences as $comp)
                            <span class="px-4 py-2 bg-gray-100 rounded-full text-sm">{{ $comp->libelle }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="p-12">
                    <div id="proposal-form" class="mb-12 bg-purple-50 p-8 rounded-3xl border border-purple-100">
                        <h2 class="text-xl font-bold text-purple-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-edit"></i> Send a Proposal
                        </h2>
                        <form action="{{ route('recruteur.propositions-send') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="candidat_id" value="{{ $profileCandidat->user_id }}">

                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex flex-col">
                                    <label class="text-xs font-bold text-gray-500 mb-1">Job Title</label>
                                    <input type="text" name="titre" placeholder="e.g. Senior UI Designer" class="px-4 py-2 border border-gray-300 rounded-lg focus:border-purple-600 outline-none">
                                </div>
                                <div class="flex flex-col">
                                    <label class="text-xs font-bold text-gray-500 mb-1">Type</label>
                                    <select name="type" class="px-4 py-2 border border-gray-300 rounded-lg outline-none">
                                        <option value="stage">Stage</option>
                                        <option value="emploi">Emploi</option>
                                        <option value="alternance">Alternance</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-xs font-bold text-gray-500 mb-1">Duration</label>
                                <input type="text" name="duree" placeholder="e.g. 6 months" class="px-4 py-2 border border-gray-300 rounded-lg outline-none">
                            </div>
                            <div class="flex flex-col">
                                <label class="text-xs font-bold text-gray-500 mb-1">Description</label>
                                <textarea name="description" rows="3" placeholder="Tell the candidate why you want them..." class="px-4 py-2 border border-gray-300 rounded-lg outline-none"></textarea>
                            </div>
                            <button type="submit" class="w-full py-3 bg-purple-700 text-white rounded-xl font-bold hover:bg-purple-800 transition-all shadow-lg shadow-purple-200">
                                Send Proposal Now
                            </button>
                        </form>
                    </div>

                    <h2 class="text-xl font-bold mb-4">Candidate's Background</h2>
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <h4 class="font-bold text-sm mb-2">Experiences</h4>
                            @forelse($profileCandidat->experiences as $exp)
                                <p class="text-sm text-gray-600 mb-2">• {{ $exp->poste }} at {{ $exp->entreprise }}</p>
                            @empty
                                <p class="text-sm text-gray-600 mb-2">Aucun experiences </p>
                            @endforelse
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <h4 class="font-bold text-sm mb-2">Certifications</h4>
                            @forelse($profileCandidat->certifications as $cert)
                                <p class="text-sm text-gray-600 mb-2">• {{ $cert->titre }} ({{ $cert->organisme }})</p>
                            @empty
                                <p class="text-sm text-gray-600 mb-2">Aucun Certification </p>

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
