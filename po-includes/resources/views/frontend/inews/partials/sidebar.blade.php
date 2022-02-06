<!-- Sidebar -->
<div class="sidebar">
    <!-- Popular Post -->
    <div class="side-card">
        <div class="side-card-header">
            <h1 class="side-card-title">Popular Post</h1>
        </div>
        <div class="side-content-wrapper">
            <div class="side-card-content">
                <div class="popular-post-wrapper" style="height: 490px">
                    @foreach (popularPost(6) as $popularPost)
                        <a href="{{ prettyUrl($popularPost) }}" class="popular-side-link">
                            <div class="popular-post">
                                <div class="popular-post-img">
                                    <img src="{{ getPicture($popularPost->picture, 'medium', $popularPost->updated_by) }}" alt="Popular Post" class="img-popular-post">
                                </div>
                                <div class="popular-post-content">
                                    <h2 class="popular-post-title">
                                        {{ $popularPost->title }}
                                    </h2>
                                    <span class="popular-post-sub">
                                        <ion-icon name="person" class="relative author-icon"></ion-icon> <span class="author">{{ $popularPost->name }}</span>
                                        <ion-icon name="calendar" class="relative date-post-icon"></ion-icon> <span class="date-posted">{{ date('d F Y', strtotime($popularPost->created_at)) }}</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div class="calendar-side">
        <div class="calendar">
            <div class="header">
                <a data-action="prev-month" href="javascript:void(0)" title="Previous Month"><i></i></a>
                <div class="text" data-render="month-year"></div>
                <a data-action="next-month" href="javascript:void(0)" title="Next Month"><i></i></a>
            </div>
            <div class="months" data-flow="left">
                <div class="month month-a">
                    <div class="render render-a"></div>
                </div>
                <div class="month month-b">
                    <div class="render render-b"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Layanan -->
    <div class="layanan-side">
        <div class="side-card">
            <div class="side-card-header">
                <h2 class="side-card-title">Layanan</h2>
            </div>
            <div class="side-card-content layanan-content">
                <div class="layanan-1">
                    <a href="https://vervalponsel.sman1rawamerta.sch.id" target="_blank" class="layanan-link verval-ponsel">
                        <div class="layanan-dimmer">
                            <h3 class="layanan-title">
                                Verval Ponsel
                            </h3>
                        </div>
                    </a>

                    <a href="https://vervalponsel.sman1rawamerta.sch.id" target="_blank" class="layanan-link verval-ponsel">
                        <div class="layanan-dimmer">
                            <h3 class="layanan-title">
                                Verval Ponsel
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="layanan-2">
                    <a href="https://vervalponsel.sman1rawamerta.sch.id" target="_blank" class="layanan-link verval-ponsel">
                        <div class="layanan-dimmer">
                            <h3 class="layanan-title">
                                Verval Ponsel
                            </h3>
                        </div>
                    </a>

                    <a href="https://vervalponsel.sman1rawamerta.sch.id" target="_blank" class="layanan-link verval-ponsel">
                        <div class="layanan-dimmer">
                            <h3 class="layanan-title">
                                Verval Ponsel
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
