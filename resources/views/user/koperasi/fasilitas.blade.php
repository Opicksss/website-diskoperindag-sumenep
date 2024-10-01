@extends('pages.dashboard')

@section('title')
    Fasilitas
@endsection

@section('style')
    <style>
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
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">FASILITAS PENDIRIAN KOPERASI</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item text-white">Bidang Koperasi</li>
                <li class="breadcrumb-item active text-white-50">Fasilitas</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @php
                    $delay = 0.2;
                    $iteration = 0;
                @endphp
                @foreach ($fasilitass as $fasilitas)
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                        <div class="service-item ">
                            <div class="service-img">
                                @if ($fasilitas->fotos->isNotEmpty())
                                    <img class="card-img-top" src="/storage/{{ $fasilitas->fotos->first()->foto }}"
                                        alt="Card image cap" style="width: 100%; height: 250px; object-fit: cover;">
                                @else
                                    <img class="card-img-top" src="{{ asset('img/cover.png') }}" alt="Card image cap"
                                        style="width: 100%; height: 250px; object-fit: cover;">
                                @endif
                                <div class="service-icon p-2">
                                    <i>{{ date('Y', strtotime($fasilitas->tanggal)) }}</i>
                                </div>
                            </div>
                            <div class="service-content blog-content p-4">
                                <a href="{{ route('show.fasilitas', $fasilitas->id) }}"
                                    class="h4 d-inline-block mb-3">{{ ucwords($fasilitas->title) }}</a>
                                <div class="content-text">
                                    {!! ($fasilitas->description) !!}
                                </div>
                                <a class="btn btn-primary rounded-pill py-2 px-4"
                                    href="{{ route('show.fasilitas', $fasilitas->id) }}">Read More</a>
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
        </div>
    </div>
    <!-- Service End -->
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
</script>
@endsection
