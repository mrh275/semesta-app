@extends(getTheme('layouts.page'))

@section('content')
    <!-- Page Image Hero -->
    <div class="big-hero page-hero-section">
        <img src="{{ getPicture($post->picture, null, $post->updated_by) }}" alt="{{ $post->title }}" class="page-img w-full h-inherit object-center object-cover">
        <div class="page-hero flex justify-center items-center h-inherit absolute top-0 w-full">
            <div class="hero-section">
                <h1 class="page-hero-title">
                    {{ $post->title }}
                </h1>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="wrapper sejarah">
            <div class="wrapper-content">
                <!-- Detail Post Section -->
                <div class="berita-container">
                    <div class="berita-terbaru-container">
                        <div class="berita-terbaru-content">
                            <div class="berita-wrapper">
                                <div class="berita-terbaru-1 berita-terbaru">
                                    <div class="page-card">
                                        <div class="page-card-title" style="display: flex; justify-content: center">
                                            <img src="{{ getPicture($post->picture, null, $post->updated_by) }}" alt="{{ $post->title }}" class="page-img">
                                        </div>
                                        <div class="page-card-content">
                                            <h1 class="page-title">
                                                {{ $post->title }}
                                            </h1>
                                            <div class="page-sub">
                                                <i class="bi bi-person-fill"></i> <span class="author">{{ $post->name }}</span>
                                                <i class="bi bi-calendar-event-fill"></i> <span class="date-posted">{{ date('d F Y', strtotime($post->created_at)) }}</span>
                                                <i class="fa fa-eye" aria-hidden="true"></i> <span class="date-posted">{{ $post->hits }} views</span>
                                            </div>
                                            <div class="page-desc">
                                                {!! $content !!}
                                            </div>
                                        </div>
                                        <div class="page-card-footer">
                                            <div class="share-wrapper">
                                                <h3 class="share-label">
                                                    Share this post :
                                                </h3>
                                                <div class="share-button-wrapper">
                                                    <a href="#" class="btn-share btn-share-fb">
                                                        <i class="bi bi-facebook"></i>
                                                    </a>
                                                    <a href="#" class="btn-share btn-share-tw">
                                                        <i class="bi bi-twitter"></i>
                                                    </a>
                                                    <a href="#" class="btn-share btn-share-ig">
                                                        <i class="fa fa-instagram" id="insta" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="whatsapp://send?text={{ prettyUrl($post) }}" data-action="share/whatsapp/share" class="btn-share btn-share-link">
                                                        <i class="bi bi-share-fill"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="tag-wrapper">
                                                <h3 class="tag-label">
                                                    Tags :
                                                </h3>
                                                <div class="tag-btn-wrapper">
                                                    <a href="#" class="tag-link">Tag</a>
                                                    <a href="#" class="tag-link">Tag</a>
                                                    <a href="#" class="tag-link">Tag</a>
                                                    <a href="#" class="tag-link">Tag</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Comment Section -->
                                    @if (getSetting('comment') == 'Y')
                                        <div class="page-card comments">
                                            <div class="page-card-title comment-title">
                                                <h1 class="page-title">
                                                    Komentar
                                                </h1>
                                                <span class="comment-count"><i class="bi bi-chat-dots-fill"></i> {{ $post->comments_count }}</span>
                                            </div>
                                            <div class="page-card-content">
                                                @if ($post->comments_count > 0)
                                                    @each(getTheme('partials.comment'), getComments($post->id, 5), 'comment', getTheme('partials.comment'))
                                                    <div class="pagination-wrapper">
                                                        {{ getComments($post->id, 5)->links() }}
                                                    </div>
                                                @else
                                                    <p class="text-center">There are no comments yet</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Comment Form Section -->
                                    <div class="page-card comment-form" id="comment-form">
                                        <div class="page-card-title comment-form-title">
                                            <h1 class="page-title">
                                                Tinggalkan Komentar
                                            </h1>
                                            <span class="form-comment-icon"> <i class="bi bi-pencil-square"></i></span>
                                        </div>
                                        <div class="page-card-content comment-form-wrapper">

                                            <!-- Alert Danger -->
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <!-- Alert Success -->
                                            @if (Session::has('flash_message'))
                                                <div class="alert alert-success">
                                                    {{ Session::get('flash_message') }}
                                                </div>
                                            @endif

                                            <!-- Replying Comment -->
                                            <div class="replying-comment" onchange="removeBtn()">

                                            </div>
                                            <form class="form-comment" method="post" action="{{ url('comment/send/' . $post->seotitle) }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="parent" id="parent" value="{{ old('parent') == null ? 0 : old('parent') }}" />
                                                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}" />
                                                <div class="comment-input">
                                                    <label for="input-comment-nama" class="comment-label">Nama</label><br>
                                                    <input type="text" name="name" id="input-comment-nama" class="input-form-comment" value="{{ old('name') }}">
                                                </div>
                                                <div class="comment-input">
                                                    <label for="input-comment-email" class="comment-label">Email</label><br>
                                                    <input type="text" name="email" class="input-form-comment" id="input-comment-email" value="{{ old('email') }}">
                                                </div>
                                                <div class="comment-input">
                                                    <label for="input-comment-area" class="comment-label">Komentar anda</label><br>
                                                    <textarea name="content" id="input-comment-area" class="comment-area">{{ old('content') }}</textarea>
                                                </div>
                                                <div class="comment-input">
                                                    {!! NoCaptcha::display() !!}
                                                </div>
                                                <div class="form-comment-btn">
                                                    <button class="btn btn-comment" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include(getTheme('partials.sidebar'))
        </div>
    </div>
@endsection
