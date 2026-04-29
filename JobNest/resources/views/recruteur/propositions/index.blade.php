@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-800">Sent Proposals</h1>
            <a href="{{ route('recruteur.dashboard') }}" class="text-sm text-purple-700 hover:underline flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="space-y-4">
            @forelse($propositions as $prop)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-purple-100 flex justify-between items-center hover:shadow-md transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 font-bold">
                            {{ substr($prop->candidat->firstName, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">{{ $prop->titre }}</h3>
                            <p class="text-sm text-gray-500">
                                To: {{ $prop->candidat->firstName }} {{ $prop->candidat->lastName }}
                            </p>
                            <div class="mt-2 flex items-center gap-2">
                            <span class="text-xs font-bold px-2 py-1 rounded-full
                                {{ $prop->status->value === 'pending' ? 'bg-blue-100 text-blue-600' : ($prop->status->value === 'accepter' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600') }}">
                                {{ ucfirst($prop->status->value) }}
                            </span>
                                <span class="text-xs text-gray-400">• {{ $prop->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('recruteur.propositions.show', $prop->id) }}" class="px-5 py-2 bg-purple-700 text-white rounded-lg text-sm hover:bg-purple-800 transition-colors">
                        View Details
                    </a>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-2xl border-2 border-dashed border-purple-200">
                    <i class="fas fa-paper-plane text-purple-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">You haven't sent any proposals yet.</p>
                </div>
            @endforelse
                <div class="mt-8">
                    {{ $propositions->links() }}
                </div>
        </div>
    </div>
@endsection
