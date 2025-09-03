<section>
    <header class="mb-4">
        <h3 class="h5 text-dark mb-2">
            {{ __('Update Password') }}
        </h3>
        <p class="text-muted small mb-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <x-input-label class="text-dark" for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" style="background-color: white; color: black;" class="form-control{{ $errors->updatePassword->has('current_password') ? ' is-invalid' : '' }}" autocomplete="current-password" />
            @if($errors->updatePassword->has('current_password'))
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="d-block" />
            @endif
        </div>

        <div class="mb-3">
            <x-input-label class="text-dark" for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" style="background-color: white; color: black;" class="form-control{{ $errors->updatePassword->has('password') ? ' is-invalid' : '' }}" autocomplete="new-password" />
            @if($errors->updatePassword->has('password'))
                <x-input-error :messages="$errors->updatePassword->get('password')" class="d-block" />
            @endif
        </div>

        <div class="mb-3">
            <x-input-label class="text-dark" for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" style="background-color: white; color: black;" class="form-control{{ $errors->updatePassword->has('password_confirmation') ? ' is-invalid' : '' }}" autocomplete="new-password" />
            @if($errors->updatePassword->has('password_confirmation'))
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="d-block" />
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
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
