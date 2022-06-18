<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Events') }}
        </h2>
    </x-slot>
    <div class="container my-5">
        <div class="row justify-content-center px-3">
            <div class="col-lg-12 col-lg-12">
                <div class="card bg-custom shadow">
                    <div class="card-body bg-custom px-5 py-3 border-bottom rounded-top">
                        <div class="mx-5 my-3 text-center">
                            <h2 class="h2 my-4 fs-2">
                                <strong>OIC Website - Create your event!</strong>
                            </h2>
                        </div>
                        <div class="row g-0 mx-5 justify-content-center mx-auto">
                            <div class="text-center">
                                <a class="btn" style="padding: 0.5rem 1.75rem" href="{{ route('events.create') }}" title="Create a event">
                                    <i class="fas fa-plus-circle fs-3"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="row col-4 col-lg-6 col-md-6 col-sm-8 g-0 mx-auto mt-4">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-danger text-white text-center border-white fs-5" style="background-color: #75b4f1;">
                                <p>{{ $message }}</p>
                                @if ($message = Session::get('code'))
                                    <p class="m-0">Code for your guests is: <span style="font-weight: bold; font-size:1.5rem; color: #e27db5">{{ Session::get('code') }}</span>
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="ecards">
                        @foreach ($events as $event)
                        <div class="ecard">
                            <div class="ecard__image-holder">
                                <img class="ecard__image" src="/storage/{{ $event->image }}" alt="wave" />
                            </div>
                            <div class="ecard-title">
                                <a href="#" class="toggle-info btn">
                                    <span class="left"></span>
                                    <span class="right"></span>
                                </a>
                                <h2>
                                    {{ $event->name }}
                                    <small>{{ $event->host->name }}</small>
                                </h2>
                            </div>
                            <div class="ecard-flap flap1">
                                <div class="ecard-description">
                                    {{ $event->introduction }}
                                </div>
                                <div class="ecard-flap flap2">
                                    <div class="ecard-actions">
                                        <a href="{{ route('events.show', $event->uuid) }}" title="Show" class="btn text-decoration-none">
                                        View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
