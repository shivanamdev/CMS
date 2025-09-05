@extends('layouts.admin')

@section('title','Dashboard')
@section('page','Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white rounded-xl p-4 shadow">
        <div class="text-gray-500 text-sm">Total Articles</div>
        <div class="text-3xl font-bold">{{ $stats['articles'] }}</div>
    </div>
    <div class="bg-white rounded-xl p-4 shadow">
        <div class="text-gray-500 text-sm">Published</div>
        <div class="text-3xl font-bold">{{ $stats['published'] }}</div>
    </div>
    <div class="bg-white rounded-xl p-4 shadow">
        <div class="text-gray-500 text-sm">Drafts</div>
        <div class="text-3xl font-bold">{{ $stats['drafts'] }}</div>
    </div>
</div>
@endsection
