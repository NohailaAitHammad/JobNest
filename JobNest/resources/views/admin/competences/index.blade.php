@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-purple-800">Competencies Library</h1>
                <p class="text-gray-500">Manage the global skills available for all candidates</p>
            </div>
            <a href="{{ route('admin.competences.create') }}" class="px-6 py-3 bg-purple-700 text-white rounded-xl font-medium hover:bg-purple-800 transition-all flex items-center gap-2">
                <i class="fas fa-plus"></i> Add New Skill
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-purple-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-purple-50 text-purple-700">
                <tr>
                    <th class="px-6 py-4 font-bold text-sm">Skill Name</th>
                    <th class="px-6 py-4 font-bold text-sm text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($competences as $comp)
                    <tr class="hover:bg-purple-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $comp->libelle }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('admin.competences.edit', $comp->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.competences.destroy', $comp->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this skill? This might affect candidates who have it.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-12 text-center text-gray-500 italic">
                            No skills defined yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
