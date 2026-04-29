@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto px-8 py-12">
        <h1 class="text-3xl font-bold text-purple-800 mb-8">User Management</h1>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-purple-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-purple-50 text-purple-700">
                <tr class="uppercase text-xs">
                    <th class="px-6 py-4 font-bold">User</th>
                    <th class="px-6 py-4 font-bold">Role</th>
                    <th class="px-6 py-4 font-bold">Status</th>
                    <th class="px-6 py-4 font-bold text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($users as $user)
                    <tr class="hover:bg-purple-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $user->firstName }} {{ $user->lastName }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2 py-1 rounded-lg bg-gray-100 text-gray-600 uppercase">
                                {{ $user->role->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2 py-1 rounded-full {{ $user->status->value === 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $user->status->value }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors" title="Toggle Status">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="px-6 py-4 bg-gray-50">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
