<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4 text-center fs-1">Reset Password</h3>

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div class="mb-3">
                                <x-input-label class="text-dark" for="email" :value="__('Email')" />
                                <x-text-input id="email" style="background-color: white; color: black;" class="form-control @error('email') is-invalid @enderror" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="d-block" />
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <x-input-label class="text-dark" for="password" :value="__('Password')" />
                                <x-text-input id="password" style="background-color: white; color: black;" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="d-block" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <x-input-label class="text-dark" for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" style="background-color: white; color: black;" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="d-block" />
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
