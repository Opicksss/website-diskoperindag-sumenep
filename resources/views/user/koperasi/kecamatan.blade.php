@extends('pages.dashboard')

@section('title')
    Kecamatan
@endsection

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.2em 0.5em;
            /* Mengubah ukuran button */
            margin-left: 2px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background: #fff;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
            font-size: 0.875rem;
            /* Menyesuaikan ukuran font */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #007bff;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #007bff;
            color: white !important;
            border: 1px solid #007bff;
        }

        .dataTables_wrapper .dataTables_length select {
            width: auto;
            display: inline-block;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            /* Membulatkan border dalam */
        }

    </style>
@endsection

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">KOPERASI BERDASARKAN KECAMATAN</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item text-white">Bidang Koperasi</li>
                <li class="breadcrumb-item active text-white-50">Kecamatan</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Striped Rows -->
    <div class="container-fluid bg-light about">
        <div class="container py-5">
            <div class="card shadow wow fadeInDown" data-wow-delay="0.2s">
                <div class="table-responsive text-nowrap p-3">
                    <table class="table table-striped table-bordered" id="kecamatan">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Kecamatan</th>
                                <th>Jumlah Koperasi</th>
                                <th>Aktif</th>
                                <th>Tidak Aktif</th>
                                <th>Jumlah Anggota</th>
                                <th>PDF or Exel</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($kecamatans as $kecamatan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ ucwords($kecamatan->nama) }}</strong></td>
                                    <td>{{ number_format($kecamatan->jumlah) }}</td>
                                    <td>{{ number_format($kecamatan->aktif) }}</td>
                                    <td>{{ number_format($kecamatan->tidak_aktif) }}</td>
                                    <td>{{ number_format($kecamatan->anggota) }}</td>
                                    <td style="width: 150px;">
                                        @if ($kecamatan->file)
                                            <a class="btn btn-outline-primary d-flex align-items-center" href="{{ asset('kecamatan/' . $kecamatan->file) }}" target="_blank"><i
                                                    class="bx bx-show-alt me-1"></i>Detail Koperasi</a>
                                        @else
                                            <span class="text-muted fst-italic" style="text-align: center; display: block;">Tidak Ada File</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ Striped Rows -->

    <!-- About Start -->
    <div class="container-fluid bg-light about">
        <div class="container py-1 ">
            <div class="row g-5 mb-5">
                <div class="col-xl-12  wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white shadow rounded p-5 h-100">
                        <div class="row g-4 justify-content-center">
                            <h3 class="text-primary text-center"><strong>Jumlah Data Koperasi</strong></h3>
                            <div class="col-sm-4">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $total['data'] }}</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Jumlah Kecamatan</h4>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $total['jumlah'] }}</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Jumlah Koperasi</h4>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $total['aktif'] }}</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Jumlah Koperasi Yang Aktif</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $total['tidak_aktif'] }}</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Jumlah Koperasi Yang Tidak Aktif</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold"
                                            data-toggle="counter-up">{{ $total['anggota'] }}</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Jumlah Anggota Koperasi</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kecamatan').DataTable({
                "pagingType": "simple_numbers",
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "<<",
                        "last": ">>",
                        "next": ">",
                        "previous": "<"
                    },
                }
            });
        });
    </script>
@endsection
