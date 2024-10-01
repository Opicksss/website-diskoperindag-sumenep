@extends('pages.dashboard')

@section('title')
    Penghargaan
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

        .date-underline p {
            display: inline-block;
            text-decoration: underline;
            margin-bottom: 1;
        }
    </style>
@endsection

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">PENGHARGAAN YANG TELAH DIRAIH</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item text-white">Bidang Koperasi</li>
                <li class="breadcrumb-item active text-white-50">Penghargaan</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->
    
    <!-- Team Start -->
    <div class="container-fluid team py-5">
        <div class="container">
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
                                    {!! ($penghargaan->description) !!}
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
        </div>
    </div>
    <!-- Team End -->
@endsection

@section('script')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const contentTexts = document.querySelectorAll('.content-text');
        contentTexts.forEach(text => {
            let maxLength = 70; // batas karakter yang ingin ditampilkan
            if (text.innerText.length > maxLength) {
                text.innerText = text.innerText.slice(0, maxLength) + '...';
            }
        });
    });
</script>
@endsection
