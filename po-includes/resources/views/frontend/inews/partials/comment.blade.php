<div class="comment-wrapper">
    <!-- Comment Parent -->
    <div class="comment" id="{{ $comment->id }}">
        <div class="user-profile-comment w-max">
            <img src="{{ asset('po-content/frontend/semesta/img/no-profile-comment.png') }}" alt="User" class="user-img-comment">
        </div>
        <div class="user-comment">
            <div class="comment-text">
                <h2 class="username-comment">{{ $comment->name }}</h2>
                <span class="comment-date">
                    <i class="bi bi-calendar-event-fill"></i> {{ date('d F Y', strtotime($comment->created_at)) }}
                </span>
                <p class="comment-desc" style="word-break: break-all">
                    {{ strip_tags($comment->content) }}
                </p>
            </div>

            <button type="button" class="btn-reply-comment">Reply <i class="bi bi-reply-fill"></i></button>
        </div>
    </div>

    @if (count($comment->children) > 0)
        @foreach ($comment->children as $comment)
            @include(getTheme('partials.subcomment'), $comment)
        @endforeach
    @endif
</div>
