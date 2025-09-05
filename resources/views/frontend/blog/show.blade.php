@extends('layouts.frontend')

@php
    $metaTitle = $article->meta_title ?: $article->title;
    $metaDescription = $article->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 160);
@endphp

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)
@section('canonical', route('blog.show', $article->slug))
@section('og_title', $metaTitle)
@section('og_description', $metaDescription)
@section('og_url', route('blog.show', $article->slug))
@section('og_image', $article->image_path ? asset('storage/'.$article->image_path) : asset('og-default.png'))

@section('title', $article->title)




@section('content')
<article class="bg-white rounded-xl shadow p-6">
    <h1 class="text-2xl font-bold">{{ $article->title }}</h1>
    <div class="text-xs text-gray-500 mt-1">
        By {{ $article->author?->name ?? 'Unknown' }} • {{ optional($article->published_at)->format('d M Y') }}
    </div>

    @if($article->image_path)
        <img src="{{ asset('storage/'.$article->image_path) }}" class="w-full rounded-lg my-4" alt="{{ $article->title }}">
    @endif

   
     <div class="prose max-w-none">{!! $article->content !!}</div>
    <div class="mt-6 flex items-center gap-3 text-sm">
        <span class="text-gray-500">Share:</span>
        <a class="underline" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}">X/Twitter</a>
        <a class="underline" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}">Facebook</a>
        <a class="underline" target="_blank" rel="noopener" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($article->title) }}">LinkedIn</a>
    </div>
</article>
@endsection
