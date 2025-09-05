<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


<div class="container my-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        
        <!-- Left Column (Image) -->
        <div class="col-md-6 d-none d-md-block text-center">
            <img src="{{ asset('image/loginbg.jpg') }}" 
                 alt="Login Background" 
                 class="img-fluid rounded shadow">
        </div>

        <!-- Right Column (Form) -->
        <div class="col-md-6 col-12 ">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <h2 class="text-center font-semibold  mb-4">Login to Your Account</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" 
                                      class="form-control mt-1 w-full" 
                                      type="email" 
                                      name="email" 
                                      :value="old('email')" 
                                      required autofocus 
                                      autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" 
                                      class="form-control mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                    </div>

                    <!-- Remember Me -->
                    {{-- <div class="form-check mb-3">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">
                            {{ __('Remember me') }}
                        </label>
                    </div> --}}

                    <!-- Actions -->
                    <div class="d-flex justify-content-between text-right align-items-center">
                        {{-- @if (Route::has('password.request'))
                            <a class="text-decoration-none small text-muted" 
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif --}}

                        <x-primary-button class="btn btn-primary px-10 font-medium">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



  



</x-guest-layout>
