<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    {{-- <title>@yield('title','Blog') CMS</title> --}}
    <title>@yield('meta_title', trim(($metaTitle ?? '') !== '' ? $metaTitle : ($title ?? 'Blog')).' • ProCMS')</title>
    <meta name="description" content="@yield('meta_description', $metaDescription ?? '')">
    <link rel="canonical" href="@yield('canonical', url()->current())"/>

    {{-- og tags --}}
    <meta property="og:type" content="@yield('og_type','article')">
    <meta property="og:title" content="@yield('og_title', $metaTitle ?? $title ?? 'Blog')">
    <meta property="og:description" content="@yield('og_description', $metaDescription ?? '')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('og-default.png'))">
    <meta property="og:site_name" content="CMS">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $metaTitle ?? $title ?? 'Blog')">
    <meta name="twitter:description" content="@yield('og_description', $metaDescription ?? '')">
    <meta name="twitter:image" content="@yield('og_image', asset('og-default.png'))">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
<header class="bg-white border-b">
    <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-xl font-bold">Content Management System (CMS)</a>
        <nav class="space-x-4 text-sm">
            <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'font-semibold' : '' }}">Blog</a>
            @auth
                <a href="{{ route('admin.dashboard') }}">Admin</a>
            @endauth
        </nav>
    </div>
</header>

<main class="max-w-5xl mx-auto px-4 py-8">
    @yield('content')
</main>

<footer class="py-8 text-center text-gray-500 text-sm">
    © {{ date('Y') }} CMS
</footer>
</body>
</html>
