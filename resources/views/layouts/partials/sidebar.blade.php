<aside 
    :class="open ? 'w-64' : 'w-16'" 
    class="bg-white shadow-lg transition-all duration-300 min-h-screen p-4 flex flex-col overflow-hidden"
>
    <!-- User Info -->
    <div class="flex items-center gap-3 mb-6" :class="open ? 'justify-start' : 'justify-center'">
        <div class="h-10 w-10 rounded-full bg-gray-200 overflow-hidden">
            <img src="{{ asset('image/avatar.png') }}" alt="Admin" class="h-full w-full object-cover">
        </div>
        <div x-show="open" x-transition class="overflow-hidden">
            <div class="font-semibold text-gray-700">{{ auth()->user()->name }}</div>
        </div>

        <!-- Toggle Button -->
        <button @click="open = !open" class="ml-auto mb-4 px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 space-y-1" x-data="{ openArticles: {{ request()->routeIs('admin.articles.*') ? 'true' : 'false' }} }">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 font-medium' : '' }}">
            <span x-show="open" x-transition>Dashboard</span>
        </a>

        <!-- Articles -->
        <div>
            <button @click="openArticles = !openArticles" 
                class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.articles.*') ? 'bg-gray-100 font-medium' : '' }}">
                <span x-show="open" x-transition>Articles</span>
                <svg x-show="open" :class="{'rotate-180': openArticles}" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Submenu -->
            <ul x-show="open && openArticles" x-transition class="pl-4 mt-1 space-y-1 overflow-hidden">
                <li>
                    <a href="{{ route('admin.articles.index') }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.articles.index') ? 'bg-gray-200 font-medium' : '' }}">
                        All Articles
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.articles.create') }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.articles.create') ? 'bg-gray-200 font-medium' : '' }}">
                        Add New
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.articles.trash') }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.articles.trash') ? 'bg-gray-200 font-medium' : '' }}">
                        Trash
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</aside>
