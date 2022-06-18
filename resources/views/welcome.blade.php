<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OIC</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="/css/card.css">
    <style>
        body {
            font-family: 'Nunito';
            background: #f7fafc;
        }
    </style>
</head>
<body>
    <div class="container-fluid fixed-top p-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <div class="mx-4">
                    @auth
                        <a href="{{ url('/about') }}" class="text-muted">About</a>
                        <a href="{{ url('/events') }}" class="ms-4 text-muted">Events</a>
                    @else
                        <a href="{{ url('/about') }}" class="text-muted">About</a>
                        <a href="{{ url('/events') }}" class="ms-4 text-muted">Events</a>
                        <a href="{{ route('login') }}" class="ms-4 text-muted">Log in</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center px-4">
            <div class="col-md-12 col-lg-9">
                <svg xmlns="http://www.w3.org/2000/svg" width='80' viewBox="0 0 306.34 250.08"><defs><style>.cls-1{fill:#5697d1;}.cls-2{fill:#e57db2;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><circle class="cls-1" cx="125" cy="125" r="125"/><rect class="cls-2" x="85.38" y="16.57" width="79.55" height="79.55" transform="translate(-3.18 105) rotate(-45)"/><rect class="cls-2" x="85.23" y="154.06" width="79.55" height="79.55" transform="translate(-100.45 145.16) rotate(-45)"/><polygon class="cls-2" points="250.09 12.5 306.33 68.75 250.09 125 306.33 181.25 250.09 237.5 137.59 125 250.09 12.5"/></g></g></svg>
                @if ($errors->any())
                    <div class="alert alert-success text-white" style="background-color: #e27db5;">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="container my-5 w-75">
            @if ($message = Session::get('fail'))
            <div class="alert alert-danger text-white text-center border-white" style="background-color: #75b4f1">
                <p class="m-0">{{ $message }}</p>
            </div>
            @endif
            <div class="card bg-custom shadow">
                <div class="card-body bg-custom px-5 py-3 border-bottom rounded-top">
                    <div class="mx-5 my-3 text-center">
                        <h2 class="h2 my-4 fs-2">
                            <strong>VIEW EVENT!</strong>
                        </h2>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-12 pe-0">
                        <div class="d-flex justify-content-center card-body border-right border-bottom p-3 h-100">
                            <div class="bd-highlight mb-3">
                                <form action="{{ route('events.join') }}" method="post" class="d-grid">
                                    @csrf
                                    <div class="col-md-12 mb-4 justify-content-center">
                                        <label for="code" class="sr-only"></label>
                                        <span class="code-input">
                                            <input placeholder="Enter Code..." type="text" name='code' pattern="[A-Za-z0-9]{8}" class="w-full py-3 px-3 fs-5" style="border: none" required>
                                            <span></span>
                                        </span>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <x-jet-button style="background-color: #e27db5; border-color: #5494d3; width: 100px; height: 50px;">
                                            {{ __('VIEW') }}
                                        </x-jet-button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
