@extends('layouts.dashboard')

@section('title')
    Admin Kelompok
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Koperasi /</span> Kelompok</h4>
        </div>
        <!-- Striped Rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Data Koperasi Berdasarkan Kelompok</h5>
                <div class="dt-action-buttons">
                    <div class="dt-buttons btn-group flex-wrap">
                        <form method="GET" action="">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#ModalCreate">
                                    <span><i class="bx bx-plus"></i> <span
                                            class="d-none d-sm-inline-block">Kelompok</span></span>
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
                            <th>Kelompok</th>
                            <th>Jumlah Koperasi</th>
                            <th>Aktif</th>
                            <th>Tidak Aktif</th>
                            <th>Jumlah Anggota</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kelompoks as $kelompok)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ ucwords($kelompok->nama) }}</strong></td>
                                <td>{{ number_format($kelompok->jumlah) }}</td>
                                <td>{{ number_format($kelompok->aktif) }}</td>
                                <td>{{ number_format($kelompok->tidak_aktif) }}</td>
                                <td>{{ number_format($kelompok->anggota) }}</td>
                                <td>
                                    @if ($kelompok->file)
                                        <a class="badge bg-label-primary" href="{{ asset('kelompok/' . $kelompok->file) }}"
                                            target="_blank"><i class="bx bx-show-alt me-1"></i>Lihat File</a>
                                    @else
                                        <span class="badge bg-label-secondary">Tidak Ada File</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{ $kelompok->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <form id="delete-form-{{ $kelompok->id }}"
                                                action="{{ route('adminkoperasikelompok.destroy', $kelompok->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="dropdown-item text-danger delete-btn"
                                                    data-kelompok-id="{{ $kelompok->id }}"
                                                    data-kelompok-title="{{ ucwords($kelompok->nama) }}">
                                                    <i class="bx bx-trash text-danger me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="ModalEdit{{ $kelompok->id }}" data-bs-backdrop="static"
                                tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('adminkoperasikelompok.update', $kelompok->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="backDropModalTitle">Edit Kelompok</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Kelompok</small></label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $kelompok->nama }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah" class="form-label">Jumlah</label>
                                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $kelompok->jumlah }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="aktif" class="form-label">Aktif</label>
                                                    <input type="number" class="form-control" id="aktif" name="aktif" value="{{ $kelompok->aktif }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tidak_aktif" class="form-label">Tidak Aktif</label>
                                                    <input type="number" class="form-control" id="tidak_aktif" name="tidak_aktif" value="{{ $kelompok->tidak_aktif }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="anggota" class="form-label">Anggota</label>
                                                    <input type="number" class="form-control" id="anggota" name="anggota" value="{{ $kelompok->anggota }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file" class="form-label">Upload File</label>
                                                    <input type="file" class="form-control" id="file"
                                                        name="file"accept=".pdf,.xls,.xlsx,.doc,.docx">
                                                    @if ($kelompok->file)
                                                        <small class="form-text text-muted">File yang diupload:
                                                            {{ $kelompok->file }}</small>
                                                    @endif
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="delete_file"
                                                        name="delete_file">
                                                    <label class="form-check-label" for="delete_file">Hapus File yang
                                                        Diunggah</label>
                                                </div>
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
                {{ $kelompoks->links('layouts.pagination') }}
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="ModalCreate" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('adminkoperasikelompok.store') }}" method="post" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Tambah Kelompok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Kelompok</small></label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input class="form-control" type="number" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="aktif" class="form-label">Aktif</label>
                        <input type="number"  class="form-control" id="aktif" name="aktif" required>
                    </div>
                    <div class="mb-3">
                        <label for="tidak_aktif" class="form-label">Tidak Aktif</label>
                        <input type="number" class="form-control" id="tidak_aktif" name="tidak_aktif" required>
                    </div>
                    <div class="mb-3">
                        <label for="anggota" class="form-label">Jumlah Anggota</label>
                        <input type="number" class="form-control" id="anggota" name="anggota" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file"
                           accept=".pdf,.xls,.xlsx,.doc,.docx">
                    </div>
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
                    const bookId = this.getAttribute('data-kelompok-id');
                    const bookTitle = this.getAttribute('data-kelompok-title');
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
    </script>
@endsection
