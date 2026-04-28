@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto px-8 py-12">
        <div class="bg-white rounded-3xl shadow-sm p-10 border border-purple-100">
            <div class="flex justify-between items-center mb-10">
                <a href="{{ route('recruteurs.propositions') }}" class="text-gray-400 hover:text-purple-700 transition-colors">
                    <i class="fas fa-arrow-left"></i> Back to list
                </a>
                <span class="px-4 py-1 rounded-full text-sm font-bold
                {{ $proposition->status->value === 'pending' ? 'bg-blue-100 text-blue-600' : ($proposition->status->value === 'accepter' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600') }}">
                {{ strtoupper($proposition->status->value) }}
            </span>
            </div>

            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center text-purple-700 text-3xl font-bold mx-auto mb-4">
                    {{ substr($proposition->candidat->firstName, 0, 1) }}
                </div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $proposition->titre }}</h1>
                <p class="text-purple-600 font-medium">Proposal for {{ $proposition->candidat->firstName }} {{ $proposition->candidat->lastName }}</p>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-12">
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
                <h3 class="text-lg font-bold text-gray-800 mb-4">Detailed Offer</h3>
                <p class="text-gray-600 leading-relaxed bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    {{ $proposition->description }}
                </p>
            </div>

            <div class="flex justify-center border-t border-gray-100 pt-8">
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-4">This is the final status of the proposal sent by you.</p>
                    <div class="flex items-center gap-3 px-6 py-3 bg-purple-100 text-purple-700 rounded-full font-bold">
                        <i class="fas fa-info-circle"></i>
                        The candidate has {{ $proposition->status->value === 'accepter' ? 'accepted' : ($proposition->status->value === 'refuser' ? 'rejected' : 'not yet responded to') }} this offer.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
