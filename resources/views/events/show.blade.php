<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Events - Detail') }}
        </h2>
    </x-slot>
    <div class="container my-5">
        <div class="card bg-custom shadow row">
            <div class="row justify-content-center py-3">
                <div class="col-sm-6 col-md-6 col-8 px-4 py-3">
                    <div class="row">
                        <div class="col-12">
                            <img src="/storage/{{ $event->image }}" class="img-thumbnail object-fit-contain"
                            style="border-radius: 1.5rem;" alt="{{ $event->name }} event!">
                        </div>
                        <div class="col-12">
                            @auth
                            <form method="post" action="{{ url('/comment/store') }}">
                                @csrf
                                <div class="card p-4 mt-3" style="background-color: #f8f9fa; display: flow-root; border-radius: 1.5rem">
                                    <div class="d-flex flex-start w-100">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="avatar" width="40" height="40" />
                                        <div class="form-outline w-100">
                                            <input type="hidden" name="name" class="form-control" value="{{ Auth::user()->name }}"/>
                                            <textarea class="form-control" name="message" id="textAreaComment" placeholder="Message" rows="2" style="background: #fff;"></textarea>
                                            <input type="hidden" name="event_id" value="{{ $event->id }}" />
                                        </div>

                                    </div>
                                    @auth
                                    <div class="float-end mt-2 pt-1">
                                        <button type="submit" class="btn btn-custom">Congrats</button>
                                    </div>
                                    @endauth
                                </div>
                            </form>
                            @else

                            <div class="mt-2 pt-1 text-center">
                                <a href="/login" class="btn btn-custom py-2 px-4 fs-4">Congrats</a>
                            </div>

                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-4 bg-body p-3 my-3" style="border-radius: 1.5rem">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 px-0">
                                <div class="pull-left">
                                    <h2 style="font-weight: bold"> {{ $event->name }}</h2>
                                    @auth
                                    @if (Auth::user()->id == $event->host->id)
                                    <h5 class="pb-2"> Event code: <span style="font-weight: bold">
                                        {{ $event->code }} </span></h5>
                                    @endif
                                    @endauth
                                    <div class="form-group py-1" style="font-weight: bold;">
                                        <i class="fas fa-user i-custom"></i>
                                        {{ $event->host->name }}
                                    </div>

                                </div>
                                <div class="d-flex pt-1 pb-3">
                                    <div class="pull-right pe-2">
                                        <a class="btn btn-primary" href="{{ route('events.index') }}" title="Go back">
                                            <i class="fas fa-backward text-white"></i> </a>
                                    </div>
                                    @auth
                                        @if (Auth::user()->id == $event->host_id)
                                            <div class="pull-right px-2">
                                                <a href="{{ route('events.edit', $event->uuid) }}" title="Edit"
                                                    class="btn text-decoration-none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="pull-right px-2">
                                                <form action="{{ route('events.destroy', $event->uuid) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete" class="btn btn-danger"
                                                        style="border: none;">
                                                        <i class="fas fa-trash text-white"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <div class="col-12 px-0">
                                <div class="form-group py-2">
                                    {{ $event->introduction }}
                                </div>
                            </div>
                            <div class="col-12 px-0">
                                <div class="form-group py-1">
                                    <i class="far fa-map i-custom"></i>
                                    {{ $event->location }}
                                </div>
                                <div class="form-group py-1">
                                    <i class="far fa-clock i-custom"></i>
                                    {{ $event->start_time->format('H:i') }}
                                </div>
                                <div class="form-group py-1">
                                    <i class="far fa-calendar i-custom"></i>
                                    {{ $event->start_time->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                        {{-- @dd() --}}
                        @php
                            $isCommented = false;
                        @endphp
                        @foreach ($event->comments as $ec)
                            @if ($ec->event_id == $event->id)
                            @php
                                $isCommented = true;
                            @endphp
                                @break
                            @else
                            @php
                                $isCommented = false;
                            @endphp
                            @endif
                        @endforeach
                        @if (!$isCommented)
                            <div class="card mb-3 mt-3" style="border-radius: 1.25rem">
                                <div class="card-body px-3">
                                    <div class="text-center">
                                        <p class="m-2 fs-5" style="font-style: italic;">
                                            Be the first people congrats to {{ $event->host->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="row comment-box mt-3 py-2 d-flex justify-content-center w-100" style="overflow-y: auto; height: 20vh">
                            <div class="col-12 col-md-12 col-lg-10 col-xl-10">
                                @include('events.comments', ['comments' => $event->comments, 'event_id' => $event->id])
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
