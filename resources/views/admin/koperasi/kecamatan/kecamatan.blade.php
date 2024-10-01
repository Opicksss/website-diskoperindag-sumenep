@extends('layouts.dashboard')

@section('title')
    Admin Detail Koperasi {{ ucwords($category->nama) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">
            <span class="text-muted fw-light">Koperasi /</span>
            <span><a href="/categorykecamatan" class="text-muted"> Kecamatan /</a></span>
            {{ ucwords($category->nama) }}
        </h4>
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('categorykecamatan.index') }}"><i class='bx bx-chevrons-left'></i> Kecamatan</a>
            </li>
        </ul>
        <!-- Striped Rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Detail Data Koperasi Kecamatan {{ ucwords($category->nama) }}</h5>
                <div class="dt-action-buttons">
                    <div class="dt-buttons btn-group flex-wrap">
                        <form method="GET" action="">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#ModalCreate">
                                    <span><i class="bx bx-plus"></i> <span
                                            class="d-none d-sm-inline-block">Koperasi</span></span>
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kecamatans as $kecamatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <form id="update-form-{{ $kecamatan->id }}"
                                        action="{{ route('adminkecamatan.keterangan', $kecamatan->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="keterangan"
                                            value="{{ $kecamatan->keterangan === 'aktif' ? 'tidak aktif' : 'aktif' }}">
                                        <button type="button"
                                            class="btn d-flex align-items-center update-btn {{ $kecamatan->keterangan === 'aktif' ? 'btn-outline-primary' : 'btn-outline-danger' }}"
                                            data-kecamatan-id="{{ $kecamatan->id }}"
                                            data-kecamatan-title="{{ ucwords($kecamatan->nama) }}"
                                            data-kecamatan-keterangan="{{ ucwords($kecamatan->keterangan) }}">
                                            {{ ucwords($kecamatan->keterangan) }}
                                        </button>
                                    </form>
                                </td>
                                <td><strong>{{ ucwords($kecamatan->nama) }}</strong></td>
                                <td>{{ $kecamatan->nik }}</td>
                                <td>{{ $kecamatan->nomor }}</td>
                                <td>{{ date('d-m-Y', strtotime($kecamatan->tanggal)) }}</td>
                                <td>{{ ucwords($kecamatan->alamat) }}</td>
                                <td>{{ ucwords($kecamatan->desa) }}</td>
                                <td>{{ ucwords($kecamatan->ketua) }}</td>
                                <td>{{ date('d-m-Y', strtotime($kecamatan->rat)) }}</td>
                                <td>Rp {{ number_format($kecamatan->aset) }}</td>
                                <td>Rp {{ number_format($kecamatan->volume) }}</td>
                                <td>Rp {{ number_format($kecamatan->shu) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{ $kecamatan->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <form id="delete-form-{{ $kecamatan->id }}"
                                                action="{{ route('adminkecamatan.destroy', $kecamatan->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="dropdown-item text-danger delete-btn"
                                                    data-kecamatan-id="{{ $kecamatan->id }}"
                                                    data-kecamatan-title="{{ ucwords($kecamatan->nama) }}">
                                                    <i class="bx bx-trash text-danger me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="ModalEdit{{ $kecamatan->id }}" data-bs-backdrop="static"
                                tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <form action="{{ route('adminkecamatan.update', $kecamatan->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="backDropModalTitle">Edit Koperasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-2">
                                                    <div class="col mb-3">
                                                        <label for="nik" class="form-label">Nomor Induk
                                                            Koperasi</label>
                                                        <input class="form-control" type="number" id="nik"
                                                            name="nik" value="{{ $kecamatan->nik }}" required>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="nama" class="form-label">Koperasi</label>
                                                        <input class="form-control" type="text" id="nama"
                                                            name="nama" value="{{ $kecamatan->nama }}" required>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-3">
                                                        <label for="nomor" class="form-label">Nomor Badan Hukum</label>
                                                        <input class="form-control" type="text" id="nomor"
                                                            name="nomor" value="{{ $kecamatan->nomor }}" required>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="tanggal" class="form-label">Tanggal Badan
                                                            Hukum</label>
                                                        <input class="form-control" type="date" id="tanggal"
                                                            name="tanggal" value="{{ $kecamatan->tanggal }}" required>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-3">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <input class="form-control" type="text" id="alamat"
                                                            name="alamat" value="{{ $kecamatan->alamat }}" required>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="desa" class="form-label">Desa / Kelurahan</label>
                                                        <input class="form-control" type="text" id="desa"
                                                            name="desa" value="{{ $kecamatan->desa }}" required>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-3">
                                                        <label for="ketua" class="form-label">Ketua</label>
                                                        <input class="form-control" type="text" id="ketua"
                                                            name="ketua" value="{{ $kecamatan->ketua }}" required>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="keterangan" class="form-label">Keterangan</label>
                                                        <select class="form-select" id="keterangan" name="keterangan"
                                                            required>
                                                            <option value="aktif"
                                                                {{ $kecamatan->keterangan == 'aktif' ? 'selected' : '' }}>
                                                                Aktif</option>
                                                            <option value="tidak aktif"
                                                                {{ $kecamatan->keterangan == 'tidak aktif' ? 'selected' : '' }}>
                                                                Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="rat" class="form-label">Tanggal RAT</label>
                                                        <input class="form-control" type="date" id="rat"
                                                            name="rat" value="{{ $kecamatan->rat }}" required>
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-3">
                                                        <label for="aset" class="form-label">Asset (Rp)</label>
                                                        <input class="form-control" type="number" id="aset"
                                                            name="aset" value="{{ $kecamatan->aset }}" required>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="volume" class="form-label">Volume Usaha (Rp)</label>
                                                        <input class="form-control" type="number" id="volume"
                                                            name="volume" value="{{ $kecamatan->volume }}" required>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="shu" class="form-label">Sisa hasil Usaha
                                                            (Rp)
                                                        </label>
                                                        <input class="form-control" type="number" id="shu"
                                                            name="shu" value="{{ $kecamatan->shu }}" required>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="Submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Modal Edit -->
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $kecamatans->links('layouts.pagination') }}
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="ModalCreate" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('adminkecamatan.store') }}" method="post" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Tambah Koperasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nik" class="form-label">Nomor Induk Koperasi</label>
                            <input class="form-control" type="number" id="nik" name="nik" required>
                        </div>
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Koperasi</label>
                            <input class="form-control" type="text" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nomor" class="form-label">Nomor Badan Hukum</label>
                            <input class="form-control" type="text" id="nomor" name="nomor" required>
                        </div>
                        <div class="col mb-3">
                            <label for="tanggal" class="form-label">Tanggal Badan Hukum</label>
                            <input class="form-control" type="date" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control" type="text" id="alamat" name="alamat" required>
                        </div>
                        <div class="col mb-3">
                            <label for="desa" class="form-label">Desa / Kelurahan</label>
                            <input class="form-control" type="text" id="desa" name="desa" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="ketua" class="form-label">Ketua</label>
                            <input class="form-control" type="text" id="ketua" name="ketua" required>
                        </div>
                        <div class="col mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <select class="form-select" id="keterangan" name="keterangan" required>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="rat" class="form-label">Tanggal RAT</label>
                            <input class="form-control" type="date" id="rat" name="rat" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="aset" class="form-label">Asset (Rp)</label>
                            <input class="form-control" type="number" id="aset" name="aset" required>
                        </div>
                        <div class="col mb-3">
                            <label for="volume" class="form-label">Volume Usaha (Rp)</label>
                            <input class="form-control" type="number" id="volume" name="volume" required>
                        </div>
                        <div class="col mb-3">
                            <label for="shu" class="form-label">Sisa hasil Usaha (Rp)</label>
                            <input class="form-control" type="number" id="shu" name="shu" required>
                        </div>
                    </div>
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="Submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Modal Create -->
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-kecamatan-id');
                    const bookTitle = this.getAttribute('data-kecamatan-title');
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: `Koperasi Atas Nama "${bookTitle}" akan dihapus`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${bookId}`).submit();
                        }
                    });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.update-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const kecamatanId = this.getAttribute('data-kecamatan-id');
                    const kecamatanTitle = this.getAttribute('data-kecamatan-title');
                    const keterangan = this.getAttribute('data-kecamatan-keterangan').toLowerCase();

                    let actionText = keterangan === 'aktif' ? 'dinonaktifkan' : 'diaktifkan';
                    let confirmButtonText = keterangan === 'aktif' ? 'Nonaktifkan' : 'Aktifkan';

                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: `Kecamatan "${kecamatanTitle}" akan ${actionText}.`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmButtonText,
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`update-form-${kecamatanId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
