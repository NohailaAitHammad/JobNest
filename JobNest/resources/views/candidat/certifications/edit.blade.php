@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-purple-100">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('candidats.certifications.index') }}" class="text-gray-400 hover:text-purple-700 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-purple-800">Update Certification</h1>
            </div>

            <form action="{{ route('candidats.certifications.update', $certification) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="flex flex-col">
                    <label class="text-sm font-bold mb-2 text-gray-700">Certification Title</label>
                    <input type="text" name="titre" value="{{ old('titre') ?? $certification->titre }}" placeholder="e.g. AWS Certified Cloud Practitioner" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                    @error('titre') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold mb-2 text-gray-700">Issuing Organization</label>
                    <input type="text" name="organisme" value="{{ old('organisme') ?? $certification->organisme }}" placeholder="e.g. Amazon Web Services, Google, Cisco..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                    @error('organisme') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold mb-2 text-gray-700">Date of Achievement</label>
                    <input type="date" name="dateObtention" value="{{ old('dateObtention') ?? $certification->dateObtention }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                    @error('dateObtention') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('candidats.certifications.index') }}" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-purple-700 text-white rounded-xl font-medium hover:bg-purple-800 transition-all">
                        Save Certification
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
