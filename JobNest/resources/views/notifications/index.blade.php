@extends('layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-800">Notification Center</h1>
            <a href="{{ route('notifications.markAllRead') }}" class="text-sm text-purple-700 hover:underline">
                Mark all as read
            </a>
        </div>

        <div class="space-y-4">
            @forelse($notifications as $notification)
                <div class="bg-white rounded-2xl p-6 shadow-sm border {{ $notification->read_at ? 'border-gray-100' : 'border-purple-300 bg-purple-50/30' }} flex justify-between items-center transition-all hover:shadow-md">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $notification->data['type'] === 'new_proposal' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                            <i class="fas {{ $notification->data['type'] === 'new_proposal' ? 'fa-paper-plane' : 'fa-check-circle' }}"></i>
                        </div>

                        <div class="flex flex-col">
                            <p class="text-gray-800 font-medium {{ $notification->read_at ? '' : 'font-bold' }}">
                                {{ $notification->data['message'] }}
                            </p>
                            <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        @if(!$notification->read_at)
                            <a href="{{ route('notifications.markRead', $notification->id) }}" class="text-xs text-purple-600 hover:text-purple-800 font-bold">
                                Mark as read
                            </a>
                        @endif

                        @if(auth()->user()->isCandidat())
                        <a href="{{ route('candidats.propositions.show', $notification->data['proposition_id']) }}"
                           class="p-2 bg-purple-700 text-white rounded-lg text-xs hover:bg-purple-800 transition-colors">
                            View
                        </a>
                        @endif
                        @if(auth()->user()->isRecruteur())
                        <a href="{{ route('recruteur.propositions.show', $notification->data['proposition_id']) }}"
                           class="p-2 bg-purple-700 text-white rounded-lg text-xs hover:bg-purple-800 transition-colors">
                            View
                        </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-2xl border-2 border-dashed border-purple-200">
                    <i class="fas fa-bell-slash text-purple-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">Your notification history is empty.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    </div>
@endsection
