@extends('pages.dashboard')

@section('title')
    Kecamatan {{ ucwords($category->nama) }}
@endsection

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="../assets1/css/datatable.css">
@endsection

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">KOPERASI DI KECAMATAN {{ strtoupper($category->nama) }}</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item text-white">Bidang Koperasi</li>
                <li class="breadcrumb-item"><a href="{{route("koperasi.categorykecamatan")}}">Kecamatan</a></li>
                <li class="breadcrumb-item active text-white-50">{{ ucwords($category->nama) }}</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Striped Rows -->
    <div class="container-fluid bg-light about">
        <div class="container py-5">
            <div class="card shadow wow fadeInDown" data-wow-delay="0.2s">
                <div class="table-responsive text-nowrap p-3">
                    <h4 class="card-title mb-1">Kecamatan {{ ucwords($category->nama) }}</h4>
                    <table class="table table-striped table-bordered" id="kecamatan">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Koperasi</th>
                                <th>No Induk Koperasi</th>
                                <th>No Badan Hukum</th>
                                <th>Tanggal</th>
                                <th>Alamat</th>
                                <th>Desa / Kelurahan</th>
                                <th>Ketua</th>
                                <th>RAT</th>
                                <th>Asset</th>
                                <th>Volume</th>
                                <th>SHU</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($kecamatans as $kecamatan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($kecamatan->keterangan === 'aktif')
                                            <span class="label label-aktif">Aktif</span>
                                        @else
                                            <span class="label label-tidak-aktif">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ ucwords($kecamatan->nama) }}</strong></td>
                                    <td>{{ $kecamatan->nik }}</td>
                                    <td>{{ $kecamatan->nomor }}</td>
                                    <td>{{ date('d-m-Y', strtotime($kecamatan->tanggal)) }}</td>
                                    <td>{{ $kecamatan->alamat }}</td>
                                    <td>{{ $kecamatan->desa }}</td>
                                    <td>{{ $kecamatan->ketua }}</td>
                                    <td>{{ date('d-m-Y', strtotime($kecamatan->rat)) }}</td>
                                    <td>Rp {{ number_format($kecamatan->aset) }}</td>
                                    <td>Rp {{ number_format($kecamatan->volume) }}</td>
                                    <td>Rp {{ number_format($kecamatan->shu) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ Striped Rows -->
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
                "scrollX": true,
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
