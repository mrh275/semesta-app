@extends(getTheme('layouts.page'))

@section('content')
    <div class="big-hero page-hero-section">
        <img src="{{ asset('po-content/uploads/404.svg') }}" alt="404" class="page-img w-full h-inherit object-center object-cover">
        <div class="page-hero flex justify-center items-center h-inherit absolute top-0 w-full">
            <div class="hero-section">
                <h1 class="page-hero-title">
                    404
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
                                            <img src="{{ asset('po-content/uploads/404.svg') }}" alt="404" class="page-img">
                                        </div>
                                        <div class="page-card-content">
                                            <h1 class="page-title" style="text-align: center; color: rgb(0,32,56)">
                                                Mau cari apa hayoo?
                                            </h1>
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
