<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ str_replace('_', '-', app()->getLocale()) }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="index, follow" />
    <meta name="generator" content="{{ config('app.version') }}" />
    <meta name="author" content="{{ getSetting('web_author') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {!! SEO::generate() !!}

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('po-content/uploads/' . getSetting('favicon')) }}" />

    {{-- CSS --}}
    <link href="{{ asset('po-content/frontend/semesta/dist/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('po-content/frontend/semesta/dist/css/page.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('po-content/frontend/semesta/dist/css/calendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('po-content/frontend/semesta/dist/css/gallery.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('po-content/frontend/semesta/dist/css/simple-lightbox.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    {{-- JS --}}
    <script src="{{ asset('po-content/frontend/semesta/dist/js/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="{{ asset('po-content/frontend/semesta/dist/js/calendar.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="{{ asset('po-content/frontend/semesta/dist/js/simple-lightbox.min.js') }}"></script>


    @stack('styles')

    <script>
        window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>
    </script>

    {!! NoCaptcha::renderJs() !!}

    @if (getSetting('google_analytics_id') != '')
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', "{{ getSetting('google_analytics_id') }}"]);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
    @endif
</head>

<body class="bg-body" id="top">
    <nav class="navbar">
        <div class="branding lg:inline-flex hidden">
            <a href="./" class="brand-link my-auto"><img src="{{ asset('po-content/uploads/' . getSetting('logo')) }}" alt="Logo SMA Negeri 1 Rawamerta" class="img-brand"></a>
            <h2 class="brand my-auto text-white font-medium">SMAN 1 Rawamerta</h2>
        </div>

        <img src="{{ asset('po-content/uploads/' . getSetting('logo')) }}" alt="Logo SMA Negeri 1 Rawamerta" class="w-8 my-auto lg:hidden">
        <h2 class="brand my-auto text-white font-medium lg:hidden">SMAN 1 Rawamerta</h2>

        <div class="menuList">
            <ul class="text-white menu-nav-lg">
                @each(getTheme('partials.menu'), getMenus(), 'menu', getTheme('partials.menu'))
                <li><a href="javascript:void(0)" class="nav-link search-button"><i class="fa fa-search"></i></a></li>
            </ul>
            <div class="search-box absolute top-2/4 invisible opacity-0 right-40 bg-gray-300 dark:bg-gray-800 rounded-md transition duration-300">
                <form action="{{ url('search') }}" method="get" class="flex items-center px-4">
                    <input type="text" name="terms" class="input-form-search focus:ring-primary" placeholder="Cari apa...">
                    <button type="submit" class="btn btn-primary ml-4"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <button class="toggleTheme ml-4">
                <span class="toggle-indicator">
                    <i class="bi bi-moon-fill darkMode showDark"></i>
                    <i class="bi bi-sun-fill lightMode"></i>
                </span>
            </button>
        </div>
        <button class="cursor-pointer hbButton" data-target="navMenuMobile">
            <div class="hb-menu bg-gray-400"></div>
            <div class="hb-menu bg-gray-400"></div>
            <div class="hb-menu bg-gray-400"></div>
        </button>
    </nav>

    <div class="menuMobile navbarMenu h-full overflow-y-auto -left-full fixed" id="navMenuMobile">
        <div class="w-full px-5 py-4">
            <img src="{{ asset('po-content/uploads/' . getSetting('logo')) }}" alt="Logo SMAN 1 Rawamerta" class="w-12 mx-auto">
            <h1 class="brand-mobile-title">SMAN 1 Rawamerta</h1>
        </div>
        <div class="mb-4">
            <button class="toggleTheme mx-auto">
                <span class="toggle-indicator">
                    <i class="bi bi-moon-fill darkMode showDark"></i>
                    <i class="bi bi-sun-fill lightMode"></i>
                </span>
            </button>
        </div>
        <form action="{{ url('search') }}" method="get" class="searchMobile flex justify-center">
            <input type="text" placeholder="&nbsp; Ketik lalu tekan Enter&nbsp;&nbsp;" name="terms" class="search-input w-0">
            <button class="search-btn" type="button"><i class="bi bi-search search-icon"></i></button>
        </form>
        <div class="menuListMobile my-5">
            <ul class="text-white menu-nav">
                @each(getTheme('partials.mobileMenu'), getMenus(), 'menu', getTheme('partials.menu'))
            </ul>
        </div>
    </div>

    <main class="page_main_wrapper">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-wrapper">
            <div class="left-footer">
                <div class="footer-brand flex justify-start">
                    <img src="{{ asset('po-content/uploads/' . getSetting('logo_footer')) }}" alt="Logo SMAN 1 Rawamerta" class="logo-footer">
                    <h2 class="brand-footer">SMAN 1 Rawamerta</h2>
                </div>
                <div class="footer-address mt-4">
                    <span class="font-semibold address-title">
                        Alamat : <br>
                    </span>
                    <span class="address">
                        <?= getSetting('address') ?>
                    </span>
                    <div class="contact-info block mt-3">
                        <span class="address"><i class="bi bi-globe2"></i> <a href="https://sman1rawamerta.sch.id" class="backlink">https://sman1rawamerta.sch.id</a></span><br>
                        <span class="address"><i class="bi bi-envelope"></i> {{ getSetting('email') }}</span><br>
                        <span class="address"><i class="bi bi-telephone-fill"></i> {{ getSetting('telephone') }}</span>
                    </div>
                </div>
            </div>
            <hr class="footer-separator">
            <div class="middle-footer">
                <div class="partner">
                    <h2 class="partner-title">Link Terkait</h2>
                    <ul class="list-disc ml-5">
                        <li class="partner-list"><a href="https://dapo.kemdikbud.go.id" class="backlink">Dapodik</a></li>
                        <li class="partner-list"><a href="https://info.gtk.kemdikbud.go.id" class="backlink">Info GTK Dapodik</a></li>
                        <li class="partner-list"><a href="https://ptk.datadik.kemdikbud.go.id" class="backlink">PTK Datadik</a></li>
                        <li class="partner-list"><a href="https://ppdb.disdik.jabarprov.go.id" class="backlink">PPDB Jawa Barat</a></li>
                        <li class="partner-list"><a href="https://gtk.belajar.kemdikbud.go.id" class="backlink">Portal GTK</a></li>
                    </ul>
                </div>
            </div>
            <hr class="footer-separator">
            <div class="right-footer">
                <h2 class="langganan">Berlangganan</h2>

                <!-- Langganan Form -->
                <form action="" class="langganan-form">
                    <input type="email" class="langganan-input" placeholder="namaanda@email.com">
                    <div class="button-form-wrapper">
                        <button class="btn btn-danger">Langganan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bottom-footer">
            <div class="bottom-footer-content">
                <span class="copyright">
                    Copyright &copy; {{ date('Y') }} <a href="https://sman1rawamerta.sch.id" class="backlink">{{ getSetting('web_author') }}</a>. All Right Reserved.
                </span>
                <span class="copyright">
                    Made with <i class="bi bi-suit-heart-fill text-red-500"></i> by Muhamad Ramdani Hidayatullah
                </span>
            </div>
        </div>
    </footer>

    <button type="button" class="btn scrollTop"><i class="bi bi-arrow-up"></i></button>

    <script src="{{ asset('po-content/frontend/semesta/dist/js/app.js') }}"></script>
    <script src="{{ asset('po-content/frontend/semesta/dist/js/page.js') }}"></script>
    <script>
        let lightbox = new SimpleLightbox(".gallery a", {
            uniqueImages: false,
        })

        // Popular post vertical carousel
        $("div.popular-post-wrapper").slick({
            vertical: true,
            accessibility: false,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2500,
            infinite: true,
        });

        $('.search-button').on('click', function() {
            $('.search-box').toggleClass('invisible');
            $('.search-box').toggleClass('visible');
            $('.search-box').toggleClass('opacity-0', 300);
            $('.search-box').toggleClass('translate-y-8');
        });

        $(document).ready(function() {
            // Scrolltop button event
            $('.scrollTop').on('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            })
        });
    </script>

    @stack('scripts')
</body>

</html>
