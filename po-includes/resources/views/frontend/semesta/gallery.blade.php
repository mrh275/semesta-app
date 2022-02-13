@extends(getTheme('layouts.app'))

@section('content')
    <!-- Page Image Hero -->
    <div class="big-hero gallery-hero-section">
        <img src="{{ isset($album)? getPicture($gallerys[0]->picture, 'medium', $gallerys[0]->updated_by): asset('po-content/uploads/medium/medium_album.jpg') }}" alt="Image-1" class="page-img w-full h-inherit object-center object-cover">
        <div class="page-hero flex justify-center items-center h-inherit absolute top-0 w-full">
            <div class="hero-section">
                @if (isset($album))
                    <h2 class="page-hero-title">Galeri | {{ $album->title }} ({{ $gallerys->total() }})</h2>
                @else
                    <h2 class="page-hero-title">Galeri | All Album</h2>
                @endif
            </div>
        </div>
    </div>

    <div class="content">
        <!-- Main -->
        <div class="gallery-wrapper">
            <div id="gallery" class="gallery-container gallery flex flex-wrap justify-center p-8">
                @if (isset($album))
                    @foreach ($gallerys as $gallery)
                        <div class="album-thumbnail" style="margin:10px">
                            <a href="{{ getPicture($gallery->picture, 'original', $gallery->updated_by) }}">
                                <img src="{{ getPicture($gallery->picture, 'medium', $gallery->updated_by) }}" alt="{{ $gallery->title }}" class="img-gallery">
                            </a>
                            <h5>
                                <a href="{{ getPicture($gallery->picture, 'original', $gallery->updated_by) }}" class="album-title">{{ $gallery->title }}</a>
                            </h5>
                        </div>
                    @endforeach
                @else
                    @foreach ($gallerys as $gallery)
                        <div class="album-thumbnail" style="margin:10px">
                            <a href="{{ url('album/' . $gallery->seotitle) }}">
                                <img src="{{ getPicture($gallery->gallerys[0]->picture, 'medium', $gallery->gallerys[0]->updated_by) }}" alt="{{ $gallery->title }}" class="img-gallery">
                            </a>
                            <h5>
                                <a href="{{ url('album/' . $gallery->seotitle) }}" class="album-title">{{ $gallery->title }} ({{ count($gallery->gallerys) }})</a>
                            </h5>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="pagination-wrapper">
                {{ $gallerys->links() }}
            </div>
        </div>
    </div>
@endsection
