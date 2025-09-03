<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4 text-center fs-1">Login</h3>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Username -->
                            <div class="mb-3">
                                <x-input-label class="text-dark form-label" for="username" :value="__('Username')" />
                                <x-text-input id="username" style="background-color: white; color: black;" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" type="text" name="username" :value="old('username')" required autofocus />
                                @if($errors->has('username'))
                                    <x-input-error :messages="$errors->get('username')" class="d-block" />
                                @endif
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <x-input-label class="text-dark form-label" for="password" :value="__('Password')" />
                                <x-text-input id="password" style="background-color: white; color: black;" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" required />
                                @if($errors->has('password'))
                                    <x-input-error :messages="$errors->get('password')" class="d-block" />
                                @endif
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-3">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="link-secondary">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary ms-2">
                                        {{ __('Log in') }}
                                    </button>
                                </div>
                            </div>
                            <div class="mt-3 d-flex justify-content-center align-items-center">
                                Don't have an account? <a href="{{ route('register') }}" class="btn btn-link">Sign up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
