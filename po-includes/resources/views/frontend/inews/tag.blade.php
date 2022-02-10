@extends(getTheme('layouts.page'))

@section('content')
    <!-- Page Image Hero -->
    <div class="big-hero page-hero-section">
        <img src="{{ isset($category)? getPicture($category->picture, 'medium', $category->updated_by): asset('po-content/uploads/bg-sekolah.jpg') }}" alt="Image-1" class="page-img w-full h-inherit object-center object-cover">
        <div class="page-hero flex justify-center items-center h-inherit absolute top-0 w-full">
            <div class="hero-section">
                <h1 class="page-hero-title">Tags : {{ $tag->title }} ({{ $posts->total() }})</h1>
            </div>
        </div>
    </div>

    <div class="content">
        <!-- Main -->
        <div class="wrapper mt-7">
            <div class="wrapper-content">
                <!-- Post Category -->
                <div class="berita-container">
                    <div class="berita-terbaru-container">
                        <div class="berita-terbaru-header">
                            <h1 class="berita-terbaru-title">Tags : {{ $tag->title }} ({{ $posts->total() }})</h1>
                        </div>

                        <div class="berita-terbaru-content">
                            <div class="berita-wrapper">
                                @foreach ($posts as $post)
                                    <a href="{{ prettyUrl($post) }}" class="berita-terbaru-1 berita-terbaru">
                                        <div class="card">
                                            <div class="card-title">
                                                <img src="{{ getPicture($post->picture, 'medium', $post->updated_by) }}" alt="{{ $post->title }}" class="berita-img">
                                            </div>
                                            <div class="card-content">
                                                <h1 class="berita-title">
                                                    {{ $post->title }}
                                                </h1>
                                                <span class="berita-sub">
                                                    <ion-icon name="person" class="relative author-icon"></ion-icon> <span class="author">{{ $post->name }}</span>
                                                    <ion-icon name="calendar" class="relative date-post-icon"></ion-icon> <span class="date-posted">{{ date('d F Y', strtotime($post->created_at)) }}</span>
                                                    <i class="fa fa-eye" aria-hidden="true"></i> <span class="date-posted">{{ $post->hits }} views</span>
                                                </span>
                                                <p class="berita-desc">
                                                    {{ \Str::limit(strip_tags($post->content), 150) }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="pagination-wrapper">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include(getTheme('partials.sidebar'))
        </div>
    </div>
@endsection
