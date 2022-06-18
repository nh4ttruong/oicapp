<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events - Create') }}
        </h2>
    </x-slot>
    <div class="container my-5">
        <div class="row justify-content-center px-3">
            <div class="col-lg-10 col-lg-8">
                <div class="card bg-custom shadow">
                    <div class="card-body bg-custom px-5 py-3 border-bottom rounded-top">
                        <div class="mx-5 my-3 text-center">
                            <h2 class="h2 my-4 fs-2">
                                <strong>Create Event</strong>
                            </h2>
                        </div>
                    </div>
                    <div class="row g-0 mx-5 my-3">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right mx-3">
                                <a class="btn btn-primary" href="{{ route('events.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
                            </div>
                        </div>
                    </div>
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
                    <div class="row mx-5">
                        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                                    <div class="form-group">
                                        <strong>Introduction:</strong>
                                        <textarea class="form-control" style="height:50px" name="introduction"
                                            placeholder="Introduction"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                                    <div class="form-group">
                                        <strong>Location:</strong>
                                        <input type="text" name="location" class="form-control" placeholder="Location">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                                    <div class="form-group">
                                        <strong>Time:</strong>
                                        <input type="datetime-local" name="start_time" class="form-control" placeholder="dd/mm/yyyy" min="{{Carbon\Carbon::now()->firstOfYear()->format('d/m/Y')}}" max="{{Carbon\Carbon::now()->lastOfYear()->format('d/m/Y')}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center justify-content-center visually-hidden my-2" id="parent-preview-image">
                                    <img id="preview-image-before-upload" style="max-height: 450px; object-fit: fill;">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                                    <div class="form-group">
                                        <strong>Image:</strong>
                                        <input type="file" accept="image/*" onchange="preview_image(event)" class="form-control" required name="image">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2 mb-4">
                                    <button type="submit" class="btn btn-custom">Submit</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
