<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin  @yield('title','Dashboard')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

<div x-data="{ open: true }" class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
  @include('layouts.partials.sidebar')
   

    <!-- Main Content -->
    <main class="flex-1">
        <!-- Topbar -->
       
  @include('layouts.partials.header')

        <section class="p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc ml-5">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </section>
    </main>
    
</div>




  @include('layouts.partials.script')

@stack('scripts')
</body>
</html>
