@extends('layouts.app')
@section('content')

    <div class="max-w-4xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h1 class="text-2xl font-bold mb-8">Account Settings</h1>


            <form action="{{ route('candidat.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">First Name</label>
                        <input type="text" name="firstName" value="{{ $user->firstName }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                        @error('firstName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Last Name</label>
                        <input type="text" name="lastName" value="{{ $user->lastName }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                        @error('lastName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Phone Number</label>
                        <input type="tel" name="telephone" value="{{ $profile->telephone?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                        @error('telephone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Ville</label>
                        <input type="text" name="ville" value="{{ $profile->ville ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                        @error('ville') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Domaine</label>
                        <input type="text" name="domaine" placeholder="Ex: Design" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 appearance-none bg-white cursor-pointer">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Upload Resume (PDF)</label>
                        <input type="file" name="cv_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('cv_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Upload Portfolio (PDF)</label>
                        <input type="file" name="portfolio_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('portfolio_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="block text-sm font-bold mb-2">Profile Image</label>
                        <input type="file" name="imageURL" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600">
                        @error('imageURL') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors">Save Changes</button>
            </form>

            <hr class="my-8 border-gray-200">

            <h2 class="text-xl font-bold mb-6">Privacy & Security</h2>

            <div class="mb-8">
                <h3 class="font-bold mb-4">Change Password</h3>
                <form action="#" method="POST" class="space-y-4 max-w-md">
                    @csrf
                    <input type="password" placeholder="Old Password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                    <input type="password" placeholder="New Password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                    <input type="password" placeholder="Confirm New Password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 form-input">
                    <button class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition-colors text-sm">Update Password</button>
                </form>
            </div>

            <div class="mb-8">
                <h3 class="font-bold mb-4">Profile Visibility</h3>
                <div class="flex items-center justify-between bg-purple-50 p-4 rounded-xl">
                    <div class="flex flex-col">
                        <p class="font-medium">Public Profile</p>
                        <p class="text-sm text-gray-500">{{ $profile->est_visible ? 'Your profile is visible to recruiters' : 'Your profile is hidden' }}</p>
                    </div>
                    <form action="{{ route('candidat.profile.toggle-visibility') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="relative inline-flex items-center cursor-pointer">
                            <div class="w-12 h-6 rounded-full {{ $profile->est_visible ? 'bg-purple-700' : 'bg-gray-300' }} transition-colors duration-200 relative">
                                <div class="absolute top-1 left-1 bg-white w-4 h-4 rounded-full transition-transform {{ $profile->est_visible ? 'translate-x-6' : 'translate-x-0' }}"></div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-12">
                <h3 class="font-bold mb-2 text-red-600">Danger Zone</h3>
                <p class="text-sm text-gray-600 mb-4">This action cannot be undone. All your data will be permanently deleted.</p>
                <form action="{{ route('candidat.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm" onclick="return confirm('Sûr de vouloir supprimer votre compte ?')">Delete Account</button>
                </form>
            </div>
        </div>
    </div>

@endsection
