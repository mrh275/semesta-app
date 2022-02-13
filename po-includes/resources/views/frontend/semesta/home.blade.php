@extends(getTheme('layouts.app'))

@section('content')
    <!-- Slider main container -->
    <div class="swiper big-hero">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach (headlinePost(5, 0) as $headlinePost)
                <div class="swiper-slide">
                    <img src="{{ getPicture($headlinePost->picture, 'original', $headlinePost->updated_by) }}" alt="Image-1" class="img-hero lg:img-hero-lg">
                    <div class="hero-bg-section">
                        <div class="hero-section">
                            <a href="{{ prettyUrl($headlinePost) }}">
                                <h1 class="hero-title">
                                    {{ $headlinePost->title }}
                                </h1>
                            </a>
                            <div class="hero-sub">
                                <ion-icon name="person" class="relative author-icon"></ion-icon> <span class="author">{{ $headlinePost->name }}</span>
                                <ion-icon name="calendar" class="relative date-post-icon"></ion-icon> <span class="date-posted">{{ date('d F Y', strtotime($headlinePost->created_at)) }}</span>
                                <i class="fa fa-eye" aria-hidden="true"></i> <span class="date-posted">{{ $headlinePost->hits }} views</span>
                            </div>
                            <div class="hero-desc">
                                <p>
                                    {{ \Str::limit(strip_tags($headlinePost->content), 150) }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ prettyUrl($headlinePost) }}" class="btn btn-primary">Read more...</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev">
            <i class="bi bi-chevron-left"></i>
        </div>
        <div class="swiper-button-next">
            <i class="bi bi-chevron-right"></i>
        </div>
    </div>

    <!-- Sambutan Kepsek Section -->
    <div class="sambutan">
        <div class="sambutan-container-left">
            <img src="{{ asset('po-content/frontend/semesta/img/no-profile.png') }}" alt="Sambutan Kepala Sekolah Image" class="sambutan-img ">
        </div>
        <div class="sambutan-container-right">
            <h2 class="sambutan-title">
                Sambutan Kepala Sekolah
            </h2>

            <p class="sambutan-desc">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, iusto! Impedit, inventore. Ducimus et, saepe rerum, neque fugit accusamus quis culpa iusto numquam aspernatur quaerat aliquam autem aperiam, vitae eos.
            </p>
        </div>
    </div>

    <!-- Main -->
    <div class="wrapper">
        <div class="wrapper-content">
            <!-- Berita Terbaru -->
            <div class="berita-container">
                <div class="berita-terbaru-container">
                    <div class="berita-terbaru-header">
                        <h1 class="berita-terbaru-title">
                            Berita Terbaru
                        </h1>
                    </div>

                    <div class="berita-terbaru-content">
                        <div class="berita-wrapper">
                            @foreach (popularPost(2, 0) as $popularPost2)
                                <a href="{{ prettyUrl($popularPost2) }}" class="berita-terbaru">
                                    <div class="card">
                                        <div class="card-title">
                                            <img src="{{ getPicture($popularPost2->picture, 'medium', $popularPost2->updated_by) }}" alt="Berita Terbaru" class="berita-img">
                                        </div>
                                        <div class="card-content">
                                            <h1 class="berita-title">
                                                {{ $popularPost2->title }}
                                            </h1>
                                            <span class="berita-sub">
                                                <ion-icon name="person" class="relative author-icon"></ion-icon> <span class="author"> {{ $popularPost2->name }}</span>
                                                <ion-icon name="calendar" class="relative date-post-icon"></ion-icon> <span class="date-posted">{{ date('d F Y', strtotime($popularPost2->created_at)) }}</span>
                                            </span>
                                            <p class="berita-desc">
                                                {{ \Str::limit(strip_tags($popularPost2->content), 100) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="berita-wrapper b-wrap-2">
                            @foreach (popularPost(2, 2) as $popularPost2)
                                <a href="{{ prettyUrl($popularPost2) }}" class="berita-terbaru">
                                    <div class="card">
                                        <div class="card-title">
                                            <img src="{{ getPicture($popularPost2->picture, 'medium', $popularPost2->updated_by) }}" alt="Berita Terbaru" class="berita-img">
                                        </div>
                                        <div class="card-content">
                                            <h1 class="berita-title">
                                                {{ $popularPost2->title }}
                                            </h1>
                                            <span class="berita-sub">
                                                <ion-icon name="person" class="relative author-icon"></ion-icon> <span class="author"> {{ $popularPost2->name }}</span>
                                                <ion-icon name="calendar" class="relative date-post-icon"></ion-icon> <span class="date-posted">{{ date('d F Y', strtotime($popularPost2->created_at)) }}</span>
                                            </span>
                                            <p class="berita-desc">
                                                {{ \Str::limit(strip_tags($popularPost2->content), 100) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ekskul Post -->
            <div class="ekskul-container">
                <div class="post-kategori-container">
                    <div class="post-kategori-header">
                        <h1 class="post-kategori-title">Latest Post</h1>
                    </div>

                    <div class="post-kategori-wrapper">
                        @foreach (latestPostWithPaging(5) as $latestPost)
                            <a href="{{ prettyUrl($latestPost) }}" class="berita-terbaru-1">
                                <div class="card">
                                    <div class="card-title">
                                        <img src="{{ getPicture($latestPost->picture, 'medium', $latestPost->updated_by) }}" alt="Latest Post" class="berita-img">
                                    </div>
                                    <div class="card-content">
                                        <h1 class="berita-title">
                                            {{ $latestPost->title }}
                                        </h1>
                                        <span class="berita-sub">
                                            <ion-icon name="person" class="relative author-icon"></ion-icon> <span class="author">{{ $latestPost->name }}</span>
                                            <ion-icon name="calendar" class="relative date-post-icon"></ion-icon> <span class="date-posted">{{ date('d F Y', strtotime($latestPost->created_at)) }}</span>
                                        </span>
                                        <p class="berita-desc">
                                            {{ \Str::limit(strip_tags($latestPost->content), 100) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @include(getTheme('partials.sidebar'))
    </div>


    <!-- Gallery -->
    <div class="gallery-wrapper">
        <div class="gallery-container">
            <div class="gallery-header">
                <h2 class="gallery-title">
                    Galeri
                </h2>
            </div>

            <div class="gallery-content">
                <div class="swiper-wrapper gallery-wrapper-section">
                    @foreach (latestGallery(8) as $latestGallery)
                        <div class="swiper-slide gallery-img-wrapper">
                            <img src="{{ getPicture($latestGallery->picture, 'medium', $latestGallery->updated_by) }}" class="gallery-img" alt="Gallery Images">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <a href="{{ url('album/all') }}" class="nav-link text-xl mt-4 font-bold" style="display: inline-block; text-align: center; color: #0099ff; " onmouseover="this.style.color='#0077ff'" onMouseOut="this.style.color='#0099ff'">Lihat lebih banyak...</a>
            </div>
        </div>
    </div>
@endsection
