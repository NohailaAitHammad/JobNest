@extends('layouts.app')
@section('content')
    <div class="max-w-2xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-purple-100">
            <h1 class="text-2xl font-bold text-purple-800 mb-8">
                {{ isset($domaine) ? 'Edit' : 'Add' }} Domain
            </h1>

            <form action="{{ isset($domaine) ? route('admin.domaines.update', $domaine->id) : route('admin.domaines.store') }}" method="POST" class="space-y-6">
                @csrf
                @if(isset($domaine)) @method('PUT') @endif

                <div class="flex flex-col">
                    <label class="text-sm font-bold mb-2 text-gray-700">Domain Name</label>
                    <input type="text" name="nomDomaine" value="{{ old('nomDomaine', $domaine->nomDomaine ?? '') }}" placeholder="e.g. Software Engineering, Marketing, Health..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                    @error('nomDomaine') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('admin.domaines.index') }}" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-purple-700 text-white rounded-xl font-medium hover:bg-purple-800 transition-all">
                        Save Domain
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
