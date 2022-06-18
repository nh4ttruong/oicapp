@foreach ($comments as $comment)
    <div class="card mb-3">
        <div class="card-body px-3 rounded">
            <div class="d-flex align-items-center">
                <img class="rounded-circle shadow-1-strong me-3"
                    src="/storage/{{ $comment->user->profile_photo_url }}"
                    alt="avatar" width="60" height="60" />
                <div>
                    <h6 class="fw-bold text-primary mb-1">{{ $comment->user->name }}</h6>
                    <p class="text-muted small mb-0 align-items-end">
                        {{ $comment->create_at }}
                    </p>
                </div>
            </div>

            <p class="mt-2 mb-2 pb-2">
                {{ $comment->message }}
            </p>

            <div class="d-flex justify-content-end text-muted" style="font-size: 0.75rem">
                <p>
                    {{ $comment->created_at->format('H:i d-m-Y'); }}
                </p>
            </div>
        </div>
    </div>
@endforeach
