<div class="grid md:grid-cols-2 gap-6">
@foreach($articles as $a)
    <article class="bg-white rounded-xl shadow p-4">
        @if($a->image_path)
            <a href="{{ route('blog.show',$a->slug) }}">
                <img src="{{ asset('storage/'.$a->image_path) }}" class="w-full h-44 object-cover rounded-lg mb-3" alt="{{ $a->title }}">
            </a>
        @endif
        <a href="{{ route('blog.show',$a->slug) }}" class="text-lg font-semibold hover:underline">{{ $a->title }}</a>
        <div class="text-xs text-gray-500 mt-1">By {{ $a->author?->name ?? 'Unknown' }} • {{ optional($a->published_at)->format('d M Y') }}</div>
        @if($a->short_des)
            <p class="text-sm text-gray-700 mt-2">{{ \Illuminate\Support\Str::limit($a->short_des, 140) }}</p>
        @else
            <p class="text-sm text-gray-700 mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($a->content), 140) }}</p>
        @endif
        <div class="mt-3">
            <a href="{{ route('blog.show',$a->slug) }}" class="text-sm font-medium text-blue-700 hover:underline">Read more →</a>
        </div>
    </article>
@endforeach
</div>

<div class="mt-6 pagination">
    {{ $articles->links() }}
</div>
