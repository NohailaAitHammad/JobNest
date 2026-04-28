@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-purple-100">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('candidats.experiences.index') }}" class="text-gray-400 hover:text-purple-700 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-purple-800">Edit Experience</h1>
            </div>

            <form action="{{ route('candidats.experiences.update', $experience->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2 text-gray-700">Job Position</label>
                        <input type="text" name="poste" value="{{ old('poste', $experience->poste) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('poste') <span cass="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2 text-gray-700">Company Name</label>
                        <input type="text" name="entreprise" value="{{ old('entreprise', $experience->entreprise) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('entreprise') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2 text-gray-700">Start Date</label>
                        <input type="date" name="dateDebut" value="{{ old('dateDebut', $experience->dateDebut) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('dateDebut') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2 text-gray-700">End Date</label>
                        <input type="date" name="dateFin" value="{{ old('dateFin', $experience->dateFin) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('dateFin') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold mb-2 text-gray-700">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">{{ old('description', $experience->description) }}</textarea>
                    @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('candidats.experiences.index') }}" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-purple-700 text-white rounded-xl font-medium hover:bg-purple-800 transition-all">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
