<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4 text-center fs-1">Forgot Password</h3>
                        
                        <div class="mb-4 text-sm text-muted">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <x-input-label class="text-dark" for="email" :value="__('Email')" />
                                <x-text-input id="email" style="background-color: white; color: black;" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" :value="old('email')" required autofocus />
                                @if($errors->has('email'))
                                    <x-input-error :messages="$errors->get('email')" class="d-block" />
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
