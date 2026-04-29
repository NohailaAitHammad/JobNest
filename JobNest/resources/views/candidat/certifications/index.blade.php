@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <div class="flex items-center gap-4 mb-8">
                    <a href="{{ route('candidat.show') }}" class="text-gray-400 hover:text-purple-700 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                <h1 class="text-3xl font-bold text-purple-800">My Certifications</h1>
                </div>
                <p class="text-gray-500">Showcase your official recognitions and diplomas</p>
            </div>
            <a href="{{ route('candidats.certifications.create') }}" class="px-6 py-3 bg-purple-700 text-white rounded-xl font-medium hover:bg-purple-800 transition-all flex items-center gap-2">
                <i class="fas fa-plus"></i> Add Certification
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-purple-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-purple-50 text-purple-700">
                <tr>
                    <th class="px-6 py-4 font-bold text-sm">Certification Title</th>
                    <th class="px-6 py-4 font-bold text-sm">Organization</th>
                    <th class="px-6 py-4 font-bold text-sm">Date</th>
                    <th class="px-6 py-4 font-bold text-sm text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($certifications as $cert)
                    <tr class="hover:bg-purple-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $cert->titre }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $cert->organisme }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $cert->dateObtention }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('candidats.certifications.edit', $cert->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('candidats.certifications.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Delete this certification?')">
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
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">
                            No certifications added yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
