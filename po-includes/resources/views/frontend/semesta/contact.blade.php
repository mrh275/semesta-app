@extends(getTheme('layouts.page'))

@section('content')
    <!-- Page Image Hero -->
    <div class="big-hero page-hero-section">
        <img src="{{ asset('po-content/uploads/bg-sekolah.jpg') }}" alt="Image-1" class="page-img w-full h-inherit object-center object-cover">
        <div class="page-hero flex justify-center items-center h-inherit absolute top-0 w-full">
            <div class="hero-section">
                <h1 class="page-hero-title">
                    Contact Us
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
                                        <div class="page-card-content" style="padding-top: 15px">
                                            <h1 class="page-title">
                                                Contact Us
                                            </h1>
                                            <div class="page-sub">
                                                <span>Jika anda memiliki kritik dan saran. Silahkan tuliskan kritik dan saran anda pada form isian dibawah ini.</span>
                                            </div>
                                            <div class="page-desc">
                                                @if (Session::has('flash_message'))
                                                    <div class="alert alert-success">
                                                        <span class="block sm:inline">{!! Session::get('flash_message') !!}</span>
                                                    </div>
                                                @endif

                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <form action="{{ url('contact/send') }}" class="contact-wrapper" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="contact-input">
                                                        <label for="input-contact-nama" class="contact-label">Nama</label><br>
                                                        <input type="text" name="name" id="input-contact-nama" class="input-form-contact" value="{{ old('name') }}">
                                                    </div>
                                                    <div class="contact-input">
                                                        <label for="input-contact-email" class="contact-label">Email</label><br>
                                                        <input type="email" name="email" class="input-form-contact" id="input-contact-email" value="{{ old('email') }}">
                                                    </div>
                                                    <div class="contact-input">
                                                        <label for="input-contact-email" class="contact-label">Subject</label><br>
                                                        <input type="text" name="subject" class="input-form-contact" id="input-contact-email" value="{{ old('subject') }}">
                                                    </div>
                                                    <div class="contact-input">
                                                        <label for="input-contact-area" class="contact-label">Kritik dan Saran anda</label><br>
                                                        <textarea name="message" id="input-contact-area" class="contact-area">{{ old('message') }}</textarea>
                                                    </div>
                                                    <div class="contact-input">
                                                        {!! NoCaptcha::display() !!}
                                                    </div>
                                                    <div class="form-contact-btn">
                                                        <button class="btn btn-contact" type="submit">Submit</button>
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
            </div>

            <!-- Sidebar -->
            @include(getTheme('partials.sidebar'))
        </div>
    </div>
@endsection
