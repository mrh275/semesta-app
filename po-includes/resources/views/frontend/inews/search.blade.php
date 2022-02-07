@extends(getTheme('layouts.page'))

@section('content')
    <!-- Page Image Hero -->
    <div class="big-hero page-hero-section">
        <img src="{{ asset('po-content/uploads/search-bg.jpg') }}" alt="Image-1" class="page-img w-full h-inherit object-center object-cover">
        <div class="page-hero flex justify-center items-center h-inherit absolute top-0 w-full">
            <div class="hero-section">
                <h1 class="page-hero-title">
                    Hasil Pencarian : @if ($posts->total() > 0) "{{ $terms }}" @else "{{ $terms }}" @endif
                </h1><br>
                <h1 class="page-hero-title">@if ($posts->total() > 0) {{ $posts->total() }} ditemukan @else Tidak ditemukan @endif</h1>
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
                        <div class="berita-terbaru-header lg:flex items-center justify-start">
                            <h1 class="berita-terbaru-title whitespace-nowrap">
                                Search Result :
                            </h1>

                            <form action="{{ url('search') }}" method="get" class="w-full pr-4 pl-4 lg:pl-0">
                                <input type="text" class="input-form-search" name="terms" placeholder="Ketik lalu tekan Enter" value="@if ($posts->total() > 0) {{ $terms }} @else {{ $terms }} @endif">
                            </form>
                        </div>

                        <div class="berita-terbaru-content">
                            <div class="berita-wrapper">
                                @if ($posts->total() > 0)
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
                                @else
                                    <div class="search-not-found">
                                        <h3 class="text-7xl font-bold">404</h3>
                                        <p class="text-xl">
                                            Sorry, we can't find what you're looking for.
                                        </p>
                                    </div>
                                @endif
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
