<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end">
                        <div class="col-sm-9">
                            <div class="row me-2">
                                <a class="text-muted text-end me-3 text-decoration-none" href="{{ route('register') }}">
                                    {{ __('Register?') }}
                                </a>
                            </div>

                            @if (Route::has('password.request'))
                            <div class="row me-2">
                                <a class="text-muted text-end me-3 text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-3 mt-1">
                            <x-jet-button style="background-color: #e27db5; border-color: #5494d3 border: #5494d3">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
