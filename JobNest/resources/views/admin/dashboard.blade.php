@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-8 py-12">
        <h1 class="text-3xl font-bold text-purple-800 mb-8">Platform Administration</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xl"><i class="fas fa-users"></i></div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xl"><i class="fas fa-user-tie"></i></div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Candidats</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_candidates'] }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600 text-xl"><i class="fas fa-building"></i></div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Recruteurs</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_recruiters'] }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 text-xl"><i class="fas fa-file-alt"></i></div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Propositions</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_propositions'] }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.users.index') }}" class="p-6 bg-white rounded-2xl shadow-sm border border-purple-100 hover:border-purple-500 transition-all group">
                <i class="fas fa-user-shield text-purple-600 text-3xl mb-4"></i>
                <h3 class="font-bold text-lg group-hover:text-purple-700">Manage Users</h3>
                <p class="text-gray-500 text-sm">Ban or unban users from the platform</p>
            </a>
            <a href="{{ route('admin.competences.index') }}" class="p-6 bg-white rounded-2xl shadow-sm border border-purple-100 hover:border-purple-500 transition-all group">
                <i class="fas fa-brain text-purple-600 text-3xl mb-4"></i>
                <h3 class="font-bold text-lg group-hover:text-purple-700">Skills Library</h3>
                <p class="text-gray-500 text-sm">Define global professional skills</p>
            </a>
            <a href="{{ route('admin.domaines.index') }}" class="p-6 bg-white rounded-2xl shadow-sm border border-purple-100 hover:border-purple-500 transition-all group">
                <i class="fas fa-globe text-purple-600 text-3xl mb-4"></i>
                <h3 class="font-bold text-lg group-hover:text-purple-700">Manage Domains</h3>
                <p class="text-gray-500 text-sm">Control industry and company domains</p>
            </a>
        </div>
    </div>
@endsection
