@extends('layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-purple-100">
            <h1 class="text-2xl font-bold mb-8">Recruiter Account Settings</h1>

            <form action="{{ route('recruteurs.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">First Name</label>
                        <input type="text" name="firstName" value="{{ $user->firstName }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('firstName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Last Name</label>
                        <input type="text" name="lastName" value="{{ $user->lastName }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('lastName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                </div>

                <hr class="border-gray-100">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">City</label>
                        <input type="text" name="ville" value="{{ $profileRecruteur->ville }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('ville') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Phone</label>
                        <input type="tel" name="telephone" value="{{ $profileRecruteur->telephone }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('telephone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Position</label>
                        <input type="text" name="poste" value="{{ $profileRecruteur->poste }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('poste') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Company Name</label>
                        <input type="text" name="nom" value="{{ $profileRecruteur->entreprise->nom ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('nom') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Employees Count</label>
                        <input type="number" name="nombreEmployees" value="{{ $profileRecruteur->entreprise->nombreEmployees ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('nombreEmployees') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Creation Date</label>
                        <input type="date" name="dateCreation" value="{{ $profileRecruteur->entreprise->dateCreation ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('dateCreation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-bold mb-2">Company Image</label>
                        <input type="file" name="imageURL" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold mb-2">Company Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">{{ $profileRecruteur->entreprise->description ?? '' }}</textarea>
                </div>

                <div class="space-y-4">
                    <label class="text-sm font-bold mb-2 block">Company Domains</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach(\App\Models\Domaine::all() as $domaine)
                            <label class="flex items-center p-3 bg-gray-50 rounded-lg border cursor-pointer hover:bg-purple-50 transition-all">
                                <input type="checkbox" name="domaine[]" value="{{ $domaine->id }}"
                                       {{ $profileRecruteur->entreprise->domaines->contains($domaine->id) ? 'checked' : '' }}
                                       class="mr-3 rounded text-purple-600">
                                <span class="text-sm text-gray-700">{{ $domaine->nomDomaine }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-purple-700 text-white rounded-xl font-bold hover:bg-purple-800 transition-all shadow-lg shadow-purple-200">
                    Save All Changes
                </button>
            </form>
        </div>
    </div>
@endsection
