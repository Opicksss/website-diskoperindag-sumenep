@extends('layouts.dashboard')

@section('title')
    Admin Kelompok
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Koperasi /</span> Kelompok</h4>
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
                            <th>Jumlah Data Koperasi</th>
                            <th>Aktif</th>
                            <th>Tidak Aktif</th>
                            <th>Tambah Koperasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categoriess as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($category->nama) }}</td>
                                <td>{{ number_format($category->total) }}</td>
                                <td>{{ number_format($category->aktif) }}</td>
                                <td>{{ number_format($category->tidak_aktif) }}</td>
                                <td style="width: 150px;">
                                    <a class="btn btn-outline-primary d-flex align-items-center"
                                        href="{{ route('adminkelompok.index', $category->id) }}"><i
                                            class="bx bx-plus me-1"></i> Koperasi</a>
                                </td>
                                <td style="width: 150px;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{ $category->id }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit</button>
                                            <form id="delete-form-{{ $category->id }}"
                                                action="{{ route('categorykelompok.destroy', $category->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="dropdown-item text-danger delete-btn"
                                                    data-category-id="{{ $category->id }}"
                                                    data-category-title="{{ ucwords($category->nama) }}">
                                                    <i class="bx bx-trash text-danger me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="ModalEdit{{ $category->id }}" data-bs-backdrop="static"
                                tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('categorykelompok.update', $category->id) }}"
                                            method="post" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        value="{{ $category->nama }}" required>
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
                {{ $categoriess->links('layouts.pagination') }}
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="ModalCreate" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('categorykelompok.store') }}" method="post" class="modal-content">
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
                    const bookId = this.getAttribute('data-category-id');
                    const bookTitle = this.getAttribute('data-category-title');
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: `Koperasi dari Kelompok "${bookTitle}" akan dihapus`,
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
