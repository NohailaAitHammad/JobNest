@extends('layouts.app')
@section('content')
    <div class="max-w-2xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-purple-100">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('admin.competences.index') }}" class="text-gray-400 hover:text-purple-700 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-purple-800">Edit Skill</h1>
            </div>

            <form action="{{ route('admin.competences.update', $competence->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="flex flex-col">
                    <label class="text-sm font-bold mb-2 text-gray-700">Skill Label</label>
                    <input type="text" name="libelle" value="{{ old('libelle', $competence->libelle) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                    @error('libelle') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('admin.competences.index') }}" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-purple-700 text-white rounded-xl font-medium hover:bg-purple-800 transition-all">
                        Update Skill
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
