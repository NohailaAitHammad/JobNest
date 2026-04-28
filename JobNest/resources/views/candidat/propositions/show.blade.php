@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto px-8 py-12">
        <div class="bg-white rounded-3xl shadow-sm p-10 border border-purple-100">
            <div class="flex justify-between items-center mb-10">
                <a href="{{ route('candidats.propositions.index') }}"
                   class="text-gray-400 hover:text-purple-700 transition-colors">
                    <i class="fas fa-arrow-left"></i> Back to list
                </a>
                <span class="px-4 py-1 rounded-full text-sm font-bold
                {{ $proposition->status->value === 'pending' ? 'bg-blue-100 text-blue-600' : ($proposition->status->value === 'accepter' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600') }}">
                {{ strtoupper($proposition->status->value) }}
            </span>
            </div>

            <div class="text-center mb-12">
                <div
                    class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-3xl font-bold mx-auto mb-4">
                    {{ substr($proposition->recruteur->firstName, 0, 1) }}
                </div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $proposition->titre }}</h1>
                <p class="text-purple-600 font-medium">{{ $proposition->recruteur->profileRecruteur->entreprise->nom ?? 'Company' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <h4 class="text-sm font-bold text-gray-400 uppercase mb-2">Offer Type</h4>
                    <p class="text-gray-800 font-medium">{{ ucfirst($proposition->type->value) }}</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <h4 class="text-sm font-bold text-gray-400 uppercase mb-2">Duration</h4>
                    <p class="text-gray-800 font-medium">{{ $proposition->duree }}</p>
                </div>
            </div>

            <div class="mb-12">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Description</h3>
                <p class="text-gray-600 leading-relaxed bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    {{ $proposition->description }}
                </p>
            </div>

            <!-- ACTIONS : Uniquement si Pending -->
            <div class="flex justify-center gap-4">
                @if($proposition->status->value === 'pending')
                    <form action="{{ route('candidats.propositions.accepter', $proposition->id) }}" method="POST">
                        @csrf
                        <button
                            class="px-8 py-3 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-100">
                            <i class="fas fa-check mr-2"></i> Accept Proposal
                        </button>
                    </form>

                    <form action="{{ route('candidats.propositions.refuser', $proposition->id) }}" method="POST">
                        @csrf
                        <button
                            class="px-8 py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-100">
                            <i class="fas fa-times mr-2"></i> Reject Proposal
                        </button>
                    </form>
                @else
                    <div class="px-6 py-3 bg-gray-100 text-gray-500 rounded-xl font-medium italic">
                        This proposal has already
                        been {{ $proposition->status->value === 'accepter' ? 'accepted' : 'rejected' }}.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
