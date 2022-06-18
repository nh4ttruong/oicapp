<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Two Factor Auth') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        <div>
            <div>Something went wrong!</div>

            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status') == 'two-factor-authentication-enabled')
        <div class="mb-4 font-medium text-sm text-green-600">
            Two factor authentication has been enabled.
        </div>
    @endif

    @if (session('status') == 'two-factor-authentication-disabled')
        <div class="mb-4 font-medium text-sm text-green-600">
            Two factor authentication has been disabled.
        </div>
    @endif

    @if (auth()->user()->two_factor_secret)
        <div>
            {!! auth()->user()->twoFactorQrCodeSvg() !!}
        </div>

        <div>
            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                <div>{{ $code }}</div>
            @endforeach
        </div>

        <div>
            <form action="/user/two-factor-recovery-codes" method="POST">
                @csrf
                <div>
                    <button>Regenerate Codes</button>
                </div>
            </form>
        </div>
    @endif

    @if (! auth()->user()->two_factor_secret)
        <form action="/user/two-factor-authentication" method="POST">
            @csrf
            <div>
                <button>Enable</button>
            </div>
        </form>
    @else
        <form action="/user/two-factor-authentication" method="POST">
            @csrf
            @method('delete')
            <div>
                <button>Disable</button>
            </div>
        </form>
    @endif

</x-app-layout>
