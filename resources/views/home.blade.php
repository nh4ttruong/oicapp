<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('About OIC') }}
        </h2>
    </x-slot>

    <div class="card-body">
        @if (session('status') == 'two-factor-authentication-disabled')
            <div class="alert alert-danger" role="alert">
                Two factor authentication has been disabled
            </div>
        @endif

        @if (session('status') == 'two-factor-authentication-enabled')
            <div class="alert alert-success" role="alert">
                Two factor authentication has been enabled
            </div>
        @endif
        <form method="post" action="/user/two-factor-authentication">
            @csrf

            @if (auth()->user()->two_factor_secret)
                @method('DELETE')
                <div class="pb-3">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
                <div class="mt-4">
                    <h3>Recovery Codes</h3>
                    <ul class="list-group mb-2">
                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                            <li class="list-group-item">{{ $code }}</li>
                        @endforeach
                    </ul>
                </div>
                <button class="btn btn-danger">
                    Disable
                </button>
            @else
                <button class="btn btn-success">
                    Enable
                </button>
            @endif
        </form>
    </div>
</x-app-layout>
