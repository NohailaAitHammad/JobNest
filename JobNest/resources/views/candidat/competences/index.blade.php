@extends('layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-purple-100">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('candidat.show') }}" class="text-gray-400 hover:text-purple-700 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-purple-800">My Skills & Competencies</h1>
            </div>

            <p class="text-gray-500 mb-8">Select the skills that best describe your professional expertise.</p>

            <form action="{{ route('candidats.competences.add') }}" method="POST" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($allCompetences as $comp)
                        @php
                            $isSelected = $profileCandidat->competences->contains($comp->id);
                        @endphp

                        <label class="skill-label flex items-center p-4 rounded-xl border cursor-pointer transition-all
                        {{ $isSelected ? 'bg-purple-100 border-purple-400' : 'bg-gray-50 border-gray-200 hover:bg-purple-50' }}">

                            <input type="checkbox" name="competences[]" value="{{ $comp->id }}"
                                   {{ $isSelected ? 'checked' : '' }}
                                   class="checkbox-input w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500 mr-3">

                            <span class="text-gray-700 font-medium {{ $isSelected ? 'text-purple-800' : '' }}">
                            {{ $comp->libelle }}
                        </span>
                        </label>
                    @endforeach
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100">
                    <button type="submit" class="px-8 py-3 bg-purple-700 text-white rounded-xl font-medium hover:bg-purple-800 transition-all shadow-lg shadow-purple-200">
                        Save My Skills
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.checkbox-input').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.closest('.skill-label');
                const text = this.nextElementSibling;

                if (this.checked) {
                    label.classList.remove('bg-gray-50', 'border-gray-200');
                    label.classList.add('bg-purple-100', 'border-purple-400');
                    text.classList.add('text-purple-800');
                } else {
                    label.classList.remove('bg-purple-100', 'border-purple-400');
                    label.classList.add('bg-gray-50', 'border-gray-200');
                    text.classList.remove('text-purple-800');
                }
            });
        });
    </script>
@endsection
