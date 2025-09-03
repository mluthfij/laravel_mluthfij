<section>
    <header class="mb-4">
        <h3 class="h5 text-dark mb-2">
            {{ __('Profile Information') }}
        </h3>
        <p class="text-muted small mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <x-input-label class="text-dark" for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" style="background-color: white; color: black;" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            @if($errors->has('name'))
                <x-input-error class="d-block" :messages="$errors->get('name')" />
            @endif
        </div>

        <div class="mb-3">
            <x-input-label class="text-dark" for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" style="background-color: white; color: black;" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            @if($errors->has('username'))
                <x-input-error class="d-block" :messages="$errors->get('username')" />
            @endif
        </div>

        <div class="mb-3">
            <x-input-label class="text-dark" for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" style="background-color: white; color: black;" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" :value="old('email', $user->email)" required autocomplete="username" />
            @if($errors->has('email'))
                <x-input-error class="d-block" :messages="$errors->get('email')" />
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small mb-2">
                        {{ __('Your email address is unverified.') }}
                    </p>
                    <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-none">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-2 mb-0">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small"
                >{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</section>
