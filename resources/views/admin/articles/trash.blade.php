@extends('layouts.admin')
@section('title','Trash')
@section('page','Trash')

@section('content')
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-2">Title</th>
                <th class="text-left px-4 py-2">Deleted At</th>
                <th class="text-right px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($articles as $a)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $a->title }}</td>
                <td class="px-4 py-2">{{ $a->deleted_at->format('d M Y H:i') }}</td>
                <td class="px-4 py-2 text-right">
                    <form method="POST" action="{{ route('admin.articles.restore', $a->id) }}" class="inline">
                        @csrf @method('PATCH')
                        <button class="text-green-700 hover:underline">Restore</button>
                    </form>
                    <form method="POST" action="{{ route('admin.articles.force', $a->id) }}" class="inline" onsubmit="return confirm('Permanently delete?')">
                        @csrf @method('DELETE')
                        <button class="ml-3 text-red-700 hover:underline">Delete Forever</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td class="px-4 py-6" colspan="3">Trash is empty.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $articles->links() }}</div>
@endsection
