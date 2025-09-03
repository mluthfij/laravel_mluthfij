<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4 text-center fs-1">Confirm Password</h3>
                        
                        <div class="mb-4 text-sm text-muted">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <!-- Password -->
                            <div class="mb-3">
                                <x-input-label class="text-dark" for="password" :value="__('Password')" />
                                <x-text-input id="password" style="background-color: white; color: black;" class="form-control @error('password') is-invalid @enderror"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="d-block" />
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
