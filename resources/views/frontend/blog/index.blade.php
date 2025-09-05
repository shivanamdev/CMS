@extends('layouts.frontend')

@section('meta_title','Blog')
@section('meta_description','Latest articles and updates.')

@section('title','Blog')

@section('content')
<h1 class="text-2xl font-bold mb-4">Latest Articles</h1>

<div id="blog-list">
    @include('frontend.blog._list', ['articles' => $articles])
</div>

<script>
document.addEventListener('click', function(e) {
    const link = e.target.closest('#blog-list .pagination a');
    if (!link) return;
    e.preventDefault();
    fetch(link.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
        .then(r => r.text())
        .then(html => { document.querySelector('#blog-list').innerHTML = html; })
        .catch(() => alert('Failed to load more posts.'));
});
</script>
@endsection
