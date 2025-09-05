@extends('layouts.admin')
@section('title','Create Article')
@section('page','Create Article')

@section('content')
<form class="bg-white rounded-xl shadow p-6 space-y-4" method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Short Description (max 300 chars)</label>
        <textarea name="short_des" maxlength="300" class="w-full border rounded px-3 py-2" rows="2">{{ old('short_des') }}</textarea>
    </div>
    <div>
  <label class="block text-sm font-medium mb-1">Content (Rich Text)</label>
  <div id="editor" class="bg-white border rounded min-h-[240px] p-2"></div>
  <textarea id="content" name="content" class="hidden">{{ old('content') }}</textarea>
</div>
    <div>
        <label class="block text-sm font-medium mb-1">Image (jpg/png/webp, max 2MB)</label>
        <input type="file" name="image" accept="image/*" class="border rounded px-3 py-2 w-full">
    </div>

{{-- seo --}}
<div class="grid md:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm font-medium mb-1">Meta Title</label>
    <input name="meta_title" value="{{ old('meta_title') }}" class="w-full border rounded px-3 py-2">
  </div>
  <div>
    <label class="block text-sm font-medium mb-1">Meta Description (max chars only 160)</label>
    <input name="meta_description" maxlength="160" value="{{ old('meta_description') }}" class="w-full border rounded px-3 py-2">
  </div>
</div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" value="1" id="is_published" class="h-4 w-4">
        <label for="is_published">Publish now</label>
    </div>
    <div class="pt-2">
        <button class="px-4 py-2 bg-black text-white rounded-lg">Save</button>
        <a class="ml-3 text-gray-600" href="{{ route('admin.articles.index') }}">Cancel</a>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  window.mountQuill({ holderId: 'editor', inputId: 'content', initialHTML: @json(old('content','')) });
});
</script>
@endpush

@endsection
