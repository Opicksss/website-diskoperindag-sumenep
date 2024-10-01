@extends('pages.dashboard')

@section('title')
    Home
@endsection

@section('style')
    <style>
        .header-carousel-item {
            position: relative;
            overflow: hidden;
        }

        .header-carousel-item .carousel-caption {
            position: relative;
        }

        .background-blur {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../assets1/img/home1.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(10px);
            z-index: 0;
            /* Optional: to slightly darken the background */
            background-color: rgba(0, 0, 0, 0.2);
        }

        .testimonial-item {
            display: flex;
            height: 200px;
            overflow: hidden;
            box-sizing: border-box;
        }

        .testimonial-item .content-text {
            flex-grow: 1;
            overflow: auto;
        }

        .testimonial-item .btn {
            margin-top: auto;
            align-self: flex-start;
        }

        .date-underline p {
            display: inline-block;
            text-decoration: underline;
            margin-bottom: 1;
        }

        .blog-content {
            display: flex;
            flex-direction: column;
            height: 250px;
            overflow: hidden;
            border: 1px solid #ddd;
            padding: 15px;
            box-sizing: border-box;
        }

        .blog-content .content-text {
            flex-grow: 1;
            overflow: auto;
        }

        .blog-content .btn {
            margin-top: auto;
            align-self: flex-start;
        }
    </style>
@endsection

@section('content')
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item"
            style="background-image: url('../assets1/img/home1.jpg'); background-size: cover; background-position: center;">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="animated fadeInLeft">
                            <div class="text-sm-center">
                                <h4 class="text-white text-uppercase fw-bold mb-4">Selamat Datang Di DKUPP Sumenep</h4>
                                <h1 class="display-1 text-white mb-4">Dinas Koperasi UKM Perindustrian dan Perdagangan</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-carousel-item position-relative">
            <div class="carousel-caption position-relative">
                <div class="background-blur"></div>
                <div class="container position-relative" style="z-index: 1;">
                    <div class="row gy-4 gy-lg-0 gx-0 gx-lg-5 align-items-center">
                        <div class="col-lg-5 animated fadeInLeft">
                            <div class="carousel-img">
                                <img src="../assets1/img/logo3.png" class="img-fluid w-100" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 animated fadeInRight">
                            <div class="text-sm-center text-md-end">
                                <h2 class="display-1 text-white mb-4">Mendukung Pertumbuhan dan Pengembangan Koperasi serta
                                    UKM</h2>
                                <p class="mb-5 fs-5">Kami berkomitmen untuk menyediakan layanan terbaik bagi koperasi dan
                                    usaha kecil menengah di wilayah kami. Temukan berbagai program dan inisiatif yang
                                    dirancang untuk membantu bisnis Anda berkembang dan sukses di industri perdagangan dan
                                    perindustrian.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5 pb-2">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 900px;">
                <h1 class="display-4 mb-4">Pengawasan Koperasi Berkala</h1>
                <p class="mb-0">Dinas Koperasi, UKM, Perdagangan, dan Perindustrian melakukan pemeriksaan rutin untuk
                    memastikan usaha patuh terhadap regulasi dan menjaga standar kualitas.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @php
                    $delay = 0.2;
                    $iteration = 0;
                @endphp
                @foreach ($pengawasans as $pengawasan)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                        <div class="blog-item">
                            <div class="blog-img">
                                @if ($pengawasan->fotos->isNotEmpty())
                                    <img class="card-img-top" src="/storage/{{ $pengawasan->fotos->first()->foto }}"
                                        alt="Card image cap" style="width: 100%; height: 300px; object-fit: cover;">
                                @else
                                    <img class="card-img-top" src="{{ asset('img/cover.png') }}" alt="Card image cap"
                                        style="width: 100%; height: 300px; object-fit: cover;">
                                @endif
                                <div class="blog-categiry py-2 px-4">
                                    <span>{{ date('d-m-Y', strtotime($pengawasan->tanggal)) }}</span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <a href="{{ route('show.pengawasan', $pengawasan->id) }}"
                                    class="h4 d-inline-block mb-3">{{ ucwords($pengawasan->title) }}</a>
                                <div class="content-text">
                                    {!! $pengawasan->description !!}
                                </div>
                                <a href="{{ route('show.pengawasan', $pengawasan->id) }}" class="btn p-0">Read More <i
                                        class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @php
                        $delay *= 2;
                        $iteration++;
                        if ($iteration % 3 == 0) {
                            $delay = 0.2;
                        }
                    @endphp
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp py-5" data-wow-delay="0.2s">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('koperasi.pengawasan') }}">View More</a>
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Blog Start -->
    <div class="container-fluid blog pb-2">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 900px;">
                <h1 class="display-4 mb-4">Pemeriksaan Kesehatan Koperasi</h1>
                <p class="mb-0">Dinas Koperasi, UKM, Perdagangan, dan Perindustrian secara rutin melakukan pemeriksaan
                    kesehatan koperasi untuk memastikan operasional yang sehat dan berkelanjutan.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @php
                    $delay = 0.2;
                    $iteration = 0;
                @endphp
                @foreach ($kesehatans as $kesehatan)
                    <div class="col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                        <div class="blog-item">
                            <div class="blog-img">
                                @if ($kesehatan->fotos->isNotEmpty())
                                    <img class="card-img-top" src="/storage/{{ $kesehatan->fotos->first()->foto }}"
                                        alt="Card image cap" style="width: 100%; height: 250px; object-fit: cover;">
                                @else
                                    <img class="card-img-top" src="{{ asset('img/cover.png') }}" alt="Card image cap"
                                        style="width: 100%; height: 250px; object-fit: cover;">
                                @endif
                                <div class="blog-categiry py-2 px-4">
                                    <span>{{ date('d-m-Y', strtotime($kesehatan->tanggal)) }}</span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <a href="{{ route('show.kesehatan', $kesehatan->id) }}"
                                    class="h4 d-inline-block mb-3">{{ ucwords($kesehatan->title) }}</a>
                                <div class="content-text">
                                    {!! $kesehatan->description !!}
                                </div>
                                <a href="{{ route('show.kesehatan', $kesehatan->id) }}" class="btn p-0">Read More <i
                                        class="fa fa-arrow-right"></i></a>
                            </div>

                        </div>
                    </div>
                    @php
                        $delay *= 2;
                        $iteration++;
                        if ($iteration % 4 == 0) {
                            $delay = 0.2;
                        }
                    @endphp
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp py-5" data-wow-delay="0.2s">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('koperasi.kesehatan') }}">View More</a>
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Service Start -->
    <div class="container-fluid service pb-2">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 900px;">
                <h1 class="display-4 mb-4">Fasilitas Pendirian Koperasi</h1>
                <p class="mb-0">Dinas Koperasi, UKM, Perdagangan, dan Perindustrian menyediakan layanan pendirian koperasi
                    untuk memudahkan masyarakat dalam membentuk koperasi yang resmi dan berdaya saing.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @php
                    $delay = 0.2;
                    $iteration = 0;
                @endphp
                @foreach ($fasilitass as $fasilitas)
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                        <div class="service-item ">
                            <div class="service-img">
                                @if ($fasilitas->fotos->isNotEmpty())
                                    <img class="card-img-top" src="/storage/{{ $fasilitas->fotos->first()->foto }}"
                                        alt="Card image cap" style="width: 100%; height: 300px; object-fit: cover;">
                                @else
                                    <img class="card-img-top" src="{{ asset('img/cover.png') }}" alt="Card image cap"
                                        style="width: 100%; height: 300px; object-fit: cover;">
                                @endif
                                <div class="service-icon p-2">
                                    <i>{{ date('Y', strtotime($fasilitas->tanggal)) }}</i>
                                </div>
                            </div>
                            <div class="service-content blog-content p-4">
                                <a href="{{ route('show.fasilitas', $fasilitas->id) }}"
                                    class="h4 d-inline-block mb-3">{{ ucwords($fasilitas->title) }}</a>
                                <div class="content-text">
                                    {!! $fasilitas->description !!}
                                </div>
                                <a class="btn btn-primary rounded-pill py-2 px-4"
                                    href="{{ route('show.fasilitas', $fasilitas->id) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                    @php
                        $delay *= 2;
                        $iteration++;
                        if ($iteration % 3 == 0) {
                            $delay = 0.2;
                        }
                    @endphp
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp py-5" data-wow-delay="0.2s">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('koperasi.fasilitas') }}">View More</a>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Team Start -->
    <div class="container-fluid team pb-2">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 900px;">
                <h1 class="display-4 mb-4">Penghargaan yang Diraih</h1>
                <p class="mb-0">Dinas Koperasi, UKM, Perdagangan, dan Perindustrian telah menerima berbagai penghargaan
                    atas dedikasi dan kontribusinya dalam mendukung pertumbuhan UMKM dan koperasi.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @php
                    $delay = 0.2;
                    $iteration = 0;
                @endphp
                @foreach ($penghargaans as $penghargaan)
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                        <div class="team-item">
                            <div class="team-img">
                                @if ($penghargaan->fotos->isNotEmpty())
                                    <img class="card-img-top" src="/storage/{{ $penghargaan->fotos->first()->foto }}"
                                        alt="Card image cap" style="width: 100%; height: 250px; object-fit: cover;">
                                @else
                                    <img class="card-img-top" src="{{ asset('img/cover.png') }}" alt="Card image cap"
                                        style="width: 100%; height: 250px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="team-title blog-content p-4">
                                <h4 class="d-inline-block mb-1">{{ ucwords($penghargaan->title) }}</h4>
                                <div class="content-text">
                                    {!! $penghargaan->description !!}
                                </div>
                                <div class="date-underline text-right">
                                    <p>{{ date('d-m-Y', strtotime($penghargaan->tanggal)) }}</p>
                                </div>
                                <a class="btn btn-primary rounded-pill py-2 px-4"
                                    href="{{ route('show.penghargaan', $penghargaan->id) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                    @php
                        $delay *= 2;
                        $iteration++;
                        if ($iteration % 4 == 0) {
                            $delay = 0.2;
                        }
                    @endphp
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp py-5" data-wow-delay="0.2s">
                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('koperasi.penghargaan') }}">View
                    More</a>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial pb-4">
        <div class="container pb-4">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 900px;">
                <h1 class="display-4 mb-4">Pameran Kami</h1>
                <p class="mb-0">Dinas Koperasi, UKM, Perdagangan, dan Perindustrian rutin berpartisipasi dalam pameran
                    untuk mendukung UMKM. Testimoni peserta menunjukkan dampak positif dari program kami.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
                @foreach ($pamerans as $pameran)
                    <div class="testimonial-item bg-light rounded">
                        <div class="row g-0">
                            <div class="col-4  col-lg-4 col-xl-3">
                                <div class="h-100">
                                    @if ($pameran->fotos->isNotEmpty())
                                        <img src="/storage/{{ $pameran->fotos->first()->foto }}"
                                            class="img-fluid h-100 rounded" style="object-fit: cover;" alt="">
                                    @else
                                        <img src="{{ asset('img/cover.png') }}" class="img-fluid h-100 rounded"
                                            style="object-fit: cover;" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-8 col-lg-8 col-xl-9">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <a href="{{ route('show.pameran', $pameran->id) }}"
                                        class="h4 d-inline-block mb-0">{{ ucwords($pameran->title) }}</a>
                                    <p class="mb-3">{{ $pameran->tanggal }}</p>
                                    <div class="content-text1">
                                        <p class="mb-0">{!! $pameran->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const contentTexts = document.querySelectorAll('.content-text');
            contentTexts.forEach(text => {
                let maxLength = 100; // batas karakter yang ingin ditampilkan
                if (text.innerText.length > maxLength) {
                    text.innerText = text.innerText.slice(0, maxLength) + '...';
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const contentTexts = document.querySelectorAll('.content-text1');
            contentTexts.forEach(text => {
                let maxLength = 80; // batas karakter yang ingin ditampilkan
                if (text.innerText.length > maxLength) {
                    text.innerText = text.innerText.slice(0, maxLength) + '...';
                }
            });
        });
    </script>
@endsection
