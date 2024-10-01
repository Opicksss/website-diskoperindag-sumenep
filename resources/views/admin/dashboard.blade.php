@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Selamat Datang {{ ucwords(Auth::user()->name) }} 🎉</h4>
                                <h5 class="card-title text-body">Dinas Koperasi UKM Perindustrian dan Perdagangan</h5>
                                <p class="mb-4">
                                    Bersiaplah untuk mengelola data dan layanan <span class="fw-bold">Koperasi</span>
                                    dengan lebih efisien
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-1 mb-3"><span class="text-muted fw-light">Jumlah Data </span> Koperasi</h4>
            </div>
            <div class="col-lg-12 col-md-8 order-1">
                <div class="row">

                    <!-- poin 1 -->
                    {{-- <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i
                                                class="bx bxs-building-house text-primary"  style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('adminkoperasikecamatan.index') }}">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-3">Koperasi Tiap Kecamatan</h5>
                                <h3 class="card-title mb-0">{{ $kecamatan }} Data</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i
                                                class="bx bxs-building text-primary"  style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('adminkoperasikelompok.index') }}">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-3">Koperasi Tiap Kelompok</h5>
                                <h3 class="card-title mb-0">{{ $kelompok }} Data</h3>
                            </div>
                        </div>
                    </div> --}}
                    <!-- //poin 1 -->

                    <!-- poin 2 -->
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i
                                                class="bx bxs-building-house text-primary"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('categorykecamatan.index') }}">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-0">Koperasi Tiap Kecamatan</h5>
                                <h4 class="card-title mb-0">{{ $categorykecamatan }} Kecamatan</h4>
                                <span>{{ $kopkecamatan }} Koperasi</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i class="bx bxs-building text-primary"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('categorykelompok.index') }}">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-0">Koperasi Tiap Kelompok</h5>
                                <h4 class="card-title mb-0">{{ $categorykelompok }} Kelompok</h4>
                                <small>{{ $kopkelompok }} Koperasi</small>
                            </div>
                        </div>
                    </div>
                    <!-- //poin 2 -->

                    <div class="col-lg-4 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i class="bx bxs-cctv text-primary"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('adminpengawasan.index') }}">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-3">Pengawasan</h5>
                                <h3 class="card-title mb-0">{{ $pengawasan }} Data</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i class="bx bx-plus-medical text-primary"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('adminkesehatan.index') }}">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-3">Kesehatan</h5>
                                <h3 class="card-title mb-0">{{ $kesehatan }} Data</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i class="bx bxs-factory text-primary"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('adminfasilitas.index') }}">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-3">Fasilitas</h5>
                                <h3 class="card-title mb-0">{{ $fasilitas }} Data</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i class="bx bxs-trophy text-primary"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('adminpenghargaan.index') }}">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-3">Penghargaan</h5>
                                <h3 class="card-title mb-0">{{ $penghargaan }} Data</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i class="bx bxs-collection text-primary"
                                                style="font-size: 24px;"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('adminpameran.index') }}">View
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="fw-semibold d-block mb-3">Pameran</h5>
                                <h3 class="card-title mb-0">{{ $pameran }} Data</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
