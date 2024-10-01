@extends('pages.dashboard')

@section('title')
    Detail Fasilitas {{ ucwords($fasilitas->title) }}
@endsection

@section('style')
    <link rel="stylesheet" href="../assets1/css/gambar.css">
@endsection

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">FASILITAS PENDIRIAN KOPERASI</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item text-white">Bidang Koperasi</li>
                <li class="breadcrumb-item"><a href="{{ route('koperasi.fasilitas') }}">Fasilitas</a></li>
                <li class="breadcrumb-item active text-white-50">{{ ucwords($fasilitas->title) }}</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-fluid bg-light about">
        <div class="container py-5">
            <div class="row gap-5" style="margin-left: 20px;">
                <div class="col-md-8 card shadow wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="description-container mx-auto">
                        <div id="pengawasanCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($fasilitas->fotos as $key => $foto)
                                    <li data-target="#pengawasanCarousel" data-slide-to="{{ $key }}"
                                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($fasilitas->fotos as $key => $foto)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="img-thumbnail d-block w-100" src="/storage/{{ $foto->foto }}"
                                            alt="Slide {{ $key + 1 }}" data-toggle="modal" data-target="#imageModal"
                                            style="width: 100%; height: 450px; object-fit: cover;">
                                    </div>
                                @endforeach
                                <!-- Modal -->
                                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog"
                                    aria-labelledby="imageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img id="modalImage" class="img-fluid" src="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- //Modal -->
                            </div>
                            <a class="carousel-control-prev" href="#pengawasanCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#pengawasanCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <h1 class="display-6 mt-2 text-center">{{ ucwords($fasilitas->title) }}</h1>
                        <div class="description-text">
                            {!! $fasilitas->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="mx-auto">
                        <h5 class="text-dark"><strong>TERBARU</strong></h5>
                        @foreach ($terbaru as $item)
                            <div class="latest-item">
                                @if ($item->fotos->isNotEmpty())
                                    <img src="/storage/{{ $item->fotos->first()->foto }}"
                                        alt="{{ ucwords($item->title) }}">
                                @else
                                    <img src="{{ asset('img/cover.png') }}" alt="{{ ucwords($item->title) }}">
                                @endif
                                <div>
                                    <a class="h6 d-inline-block"
                                        href="{{ route('show.fasilitas', $item->id) }}">{{ Str::limit(ucwords($item->title), 50) }}</a>
                                    <span class="date">{{ $item->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        @endforeach
                        <h5 class="text-dark mt-5"><strong>QUICK ACCESS</strong></h5>
                        <a href="{{ route('koperasi.kecamatan') }}" class="h6 d-inline-block"><i
                                class='bx bx-chevron-right me-2'></i>Koperasi Tiap Kecamatan</a>
                        <a href="{{ route('koperasi.kelompok') }}" class="h6 d-inline-block"><i
                                class='bx bx-chevron-right me-2'></i>Koperasi Tiap Kelompok</a>
                        <a href="{{ route('koperasi.pengawasan') }}" class="h6 d-inline-block"><i
                                class='bx bx-chevron-right me-2'></i>Kegiatan Pemeriksaan dan Pengawasan</a>
                        <a href="{{ route('koperasi.kesehatan') }}" class="h6 d-inline-block"><i
                                class='bx bx-chevron-right me-2'></i>Kegiatan Pemeriksaan Kesehatan</a>
                        <a href="{{ route('koperasi.fasilitas') }}" class="h6 d-inline-block"><i
                                class='bx bx-chevron-right me-2'></i>Fasilitas Pendirian Koperasi</a>
                        <a href="{{ route('koperasi.penghargaan') }}" class="h6 d-inline-block"><i
                                class='bx bx-chevron-right me-2'></i>Penghargaan</a><br>
                        <a href="{{ route('koperasi.pameran') }}" class="h6 d-inline-block"><i
                                class='bx bx-chevron-right me-2'></i>Pameran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#pengawasanCarousel').carousel({
            interval: 10000 // Interval waktu antar slide dalam milidetik
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.img-thumbnail').on('click', function() {
                var imgSrc = $(this).attr('src');
                $('#modalImage').attr('src', imgSrc);
            });
        });
    </script>
@endsection
