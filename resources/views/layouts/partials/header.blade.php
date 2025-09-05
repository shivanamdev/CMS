 <header class="bg-white shadow p-4 flex items-center justify-between">
            <div class="text-xl font-semibold">@yield('page','Admin')</div>
            <div class="flex items-center gap-3">
                <img class="h-9 w-9 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" alt="Avatar">
                <div class="relative">
                    <details>
                        <summary class="cursor-pointer text-sm">Profile</summary>
                        <div class="absolute right-0 mt-2 w-40 bg-white rounded shadow border">
                            <a class="block px-3 py-2 hover:bg-gray-50" href="{{ route('profile.edit') }}">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-3 py-2 hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </details>
                </div>
            </div>
        </header>