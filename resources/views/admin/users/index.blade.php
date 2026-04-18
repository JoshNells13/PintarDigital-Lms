@extends('layouts.dashboard')

@section('title', 'Manage Users | Sanctuary Admin')
@section('header', 'Platform Members')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold tracking-tight">Active Members</h2>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-primary text-on-primary text-xs font-bold uppercase rounded-xl hover:bg-primary-container transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">person_add</span>
            Add New User
        </a>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left">
            <thead class="bg-surface-container-low text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/5">
                @foreach($users as $user)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-sm">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                {{ $user->role === 'admin' ? 'bg-error/10 text-error' : ($user->role === 'instructor' ? 'bg-primary/10 text-primary' : 'bg-secondary/10 text-secondary') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-on-surface-variant hover:bg-error/10 hover:text-error rounded-lg transition-colors" onclick="return confirm('Are you sure?')">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
