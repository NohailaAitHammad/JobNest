@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex flex-col md:flex-row gap-8">

            <!-- Sidebar Filtres -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-purple-100 sticky top-24">
                    <h2 class="text-xl font-bold text-purple-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-filter"></i> Filters
                    </h2>

                    <form action="{{ route('recruteur.search-candidats') }}" method="GET" class="space-y-6">
                        <!-- Ville -->
                        <div class="flex flex-col">
                            <label class="text-sm font-bold mb-2 text-gray-700">City</label>
                            <input type="text" name="ville" value="{{ request('ville') }}" placeholder="e.g. Casablanca"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        </div>

                        <!-- Statut -->
                        <div class="flex flex-col">
                            <label class="text-sm font-bold mb-2 text-gray-700">Status</label>
                            <select name="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="banni" {{ request('status') === 'banni' ? 'selected' : '' }}>Banned
                                </option>
                            </select>
                        </div>

                        <!-- Compétences -->
                        <div class="flex flex-col">
                            <label class="text-sm font-bold mb-2 text-gray-700">Skills</label>
                            <div class="max-h-60 overflow-y-auto space-y-2 pr-2y-scroll">
                                @foreach($allCompetences as $comp)
                                    <label
                                        class="flex items-center p-2 bg-gray-50 rounded-lg cursor-pointer hover:bg-purple-50 transition-all">
                                        <input type="checkbox" name="competences[]" value="{{ $comp->id }}"
                                               {{ in_array($comp->id, request('competences', []), true) ? 'checked' : '' }}
                                               class="mr-3 rounded text-purple-600">
                                        <span class="text-sm text-gray-700">{{ $comp->libelle }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Niveau -->
                        <div class="flex flex-col">
                            <label class="text-sm font-bold mb-2 text-gray-700">Experience Level</label>
                            <select name="niveau"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                                <option value="">All Levels</option>
                                <option value="debutant" {{ request('niveau') === 'debutant' ? 'selected' : '' }}>
                                    Beginner
                                </option>
                                <option
                                    value="intermediaire" {{ request('niveau') === 'intermediaire' ? 'selected' : '' }}>
                                    Intermediate
                                </option>
                                <option value="expert" {{ request('niveau') === 'expert' ? 'selected' : '' }}>Expert
                                </option>
                            </select>
                        </div>

                        <button type="submit"
                                class="w-full py-3 bg-purple-700 text-white rounded-xl font-bold hover:bg-purple-800 transition-all shadow-lg shadow-purple-200">
                            Apply Filters
                        </button>
                        <a href="{{ route('recruteur.search-candidats') }}"
                           class="block text-center text-sm text-gray-400 hover:text-gray-600 transition-colors">Reset
                            all</a>
                    </form>
                </div>
            </div>

            <!-- Liste des Candidats -->
            <div class="w-full md:w-3/4">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-purple-800">Find the Best Talents</h1>
                    <span class="text-gray-500 text-sm">Showing {{ $candidats->firstItem() }} to {{ $candidats->lastItem() }} of {{ $candidats->total() }} candidates</span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @forelse($candidats as $candidat)
                        <div
                            class="bg-white rounded-2xl p-6 shadow-sm border border-purple-100 hover:shadow-md transition-all flex gap-6">
                            <img
                                src="{{ $candidat->imageURL ? asset('storage/' . $candidat->imageURL) : 'https://ui-avatars.com/api/?name='. $candidat->user->firstName }}"
                                class="w-24 h-24 rounded-2xl object-cover border-2 border-purple-100" alt="">

                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $candidat->user->firstName }} {{ $candidat->user->lastName }}</h3>
                                    <span class="text-xs font-bold px-2 py-1 rounded-full  {{ $candidat->user->status->value === 'active' ? "text-green-600 bg-green-100" : "text-red-600 bg-red-100" }} ">{{ $candidat->user->status }}</span>
                                </div>
                                <p class="text-purple-600 font-medium mb-2">{{ $candidat->ville }}</p>
                                <div class="flex flex-wrap gap-1 mb-4">
                                    @foreach($candidat->competences->take(3) as $comp)
                                        <span
                                            class="text-[10px] px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full border border-gray-200">
                                        {{ $comp->libelle }}
                                    </span>
                                    @endforeach
                                    @if($candidat->competences->count() > 3)
                                        <span class="text-[10px] text-gray-400">+{{ $candidat->competences->count() - 3 }} more</span>
                                    @endif
                                </div>
                                <a href="{{ route('recruteur.show-candidat', $candidat->id) }}"
                                   class="px-4 py-2 bg-purple-700 text-white rounded-lg text-sm hover:bg-purple-800 transition-colors">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-20 bg-white rounded-2xl border-2 border-dashed border-purple-200">
                            <i class="fas fa-search text-purple-300 text-5xl mb-4"></i>
                            <p class="text-gray-500">No candidates match your filters.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $candidats->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
