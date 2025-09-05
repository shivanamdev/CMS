@extends('layouts.admin')
@section('title','Articles')
@section('page','Articles')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">All Articles</h2>
    <a href="{{ route('admin.articles.create') }}" class="px-4 py-2 bg-black text-white rounded-lg">Add New</a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-2">Title</th>
                <th class="text-left px-4 py-2">Author</th>
                <th class="text-left px-4 py-2">Status</th>
                <th class="text-left px-4 py-2">Created</th>
                <th class="text-right px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($articles as $a)
            <tr class="border-t">
                <td class="px-4 py-2">
                    <div class="font-medium">{{ $a->title }}</div>
                    <div class="text-gray-500 text-xs">/{{ $a->slug }}</div>
                </td>
                <td class="px-4 py-2">{{ $a->author?->name ?? '—' }}</td>
                <td class="px-4 py-2">
                    @if($a->is_published)
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Published</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Draft</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $a->created_at->format('d M Y') }}</td>
                <td class="px-4 py-2 text-right">
                    <a class="text-blue-600 hover:underline" href="{{ route('admin.articles.edit', $a) }}">Edit</a>
                    <form action="{{ route('admin.articles.destroy', $a) }}" method="POST" class="inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="ml-3 text-red-600 hover:underline" onclick="confirmDelete(this)">Delete</button>
                    </form>
                    <a href="{{ route('admin.articles.trash') }}" class="text-blue-400 hover:underline">Trash</a>

                </td>
            </tr>
        @empty
            <tr><td class="px-4 py-6" colspan="5">No articles yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $articles->links() }}</div>
@endsection
