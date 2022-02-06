@extends(getTheme('layouts.page'))

@section('content')
    <div class="big-hero page-hero-section">
        <img src="{{ asset('po-content/uploads/bg-sekolah.jpg') }}" alt="{{ $pages->title }}" class="page-img w-full h-inherit object-center object-cover">
        <div class="page-hero flex justify-center items-center h-inherit absolute top-0 w-full">
            <div class="hero-section">
                <h1 class="page-hero-title">
                    {{ $pages->title }}
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
                                        <div class="page-card-title">
                                            <img src="{{ getPicture($pages->picture, null, $pages->updated_by) }}" alt="{{ $pages->title }}" class="page-img">
                                        </div>
                                        <div class="page-card-content">
                                            <h1 class="page-title">
                                                {{ $pages->title }}
                                            </h1>
                                            <div class="page-sub">

                                            </div>
                                            <div class="page-desc">
                                                {!! $pages->content !!}
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
                                                    <a href="#" class="btn-share btn-share-link">
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
