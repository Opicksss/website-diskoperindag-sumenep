@extends('layouts.dashboard')

@section('title')
    Admin Pengawasan
@endsection

@section('style')
    <style>
        .photo-container {
            display: flex;
            flex-wrap: wrap;
            /* Agar foto melanjutkan ke baris berikutnya jika tidak muat */
            gap: 10px;
            /* Jarak antara foto */
        }

        .photo-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 120px;
            /* Atur lebar untuk menyesuaikan dengan ukuran foto dan checkbox */
            text-align: center;
            /* Agar teks (checkbox) berada di bawah gambar secara terpusat */
        }

        .photo-item img {
            max-width: 100px;
            /* Batas lebar gambar */
            max-height: 100px;
            /* Batas tinggi gambar */
        }

        .photo-item .checkbox-wrapper {
            display: flex;
            align-items: center;
            /* Jarak antara gambar dan checkbox */
        }

        .photo-item input[type="checkbox"] {
            margin-top: 10px;
            /* Jarak antara gambar dan checkbox */
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Koperasi /</span> Pengawasan</h4>
        </div>
        <!-- Striped Rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Data Kegiatan Pemeliharaan dan Pengawasan Koperasi</h5>
                <div class="dt-action-buttons">
                    <div class="dt-buttons btn-group flex-wrap">
                        <form method="GET" action="">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#ModalCreate">
                                    <span><i class="bx bx-plus"></i> <span
                                            class="d-none d-sm-inline-block">Pengawasan</span></span>
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
                            <th>Judul</th>
                            <th>Deskrisi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($pengawasans as $pengawasan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ ucwords($pengawasan->title) }}</strong></td>
                                <td>{!! Str::limit($pengawasan->description, 100) !!}</td>
                                <td>{{ date('d-m-Y', strtotime($pengawasan->tanggal)) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('adminpengawasan.show', $pengawasan->id) }}"><i
                                                    class="bx bx-show-alt me-1"></i> Show</a>
                                            <form id="delete-form-{{ $pengawasan->id }}"
                                                action="{{ route('adminpengawasan.destroy', $pengawasan->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="dropdown-item text-danger delete-btn"
                                                    data-pengawasan-id="{{ $pengawasan->id }}"
                                                    data-pengawasan-title="{{ ucwords($pengawasan->title) }}">
                                                    <i class="bx bx-trash text-danger me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $pengawasans->links('layouts.pagination') }}
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="ModalCreate" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl" role="document">
            <form action="{{ route('adminpengawasan.store') }}" method="post" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Tambah Pengawasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="title" class="form-label">Judul</small></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="7" name="description" required></textarea>
                    </div>
                    <div class="mb-3" id="create-photo-upload-container">
                        <div class="photo-input-group">
                            <label class="form-label">Foto 1</label>
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="flex-grow-1 me-1">
                                    <input class="form-control" type="file" name="fotos[]"  accept="image/*">
                                </div>
                                <div class="py-1">
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="removePhotoInput(this, '${modalType}')">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addPhotoInput('create')"><i
                            class="bx bx-plus"></i> FOTO</button>
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
                    const bookId = this.getAttribute('data-pengawasan-id');
                    const bookTitle = this.getAttribute('data-pengawasan-title');
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: `Data Pengawasan Dengan Judul "${bookTitle}" akan dihapus`,
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
    <script>
        function addPhotoInput(modalType) {
            const container = document.getElementById(modalType + '-photo-upload-container');
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'photo-input-group';
            newInputGroup.innerHTML = `
        <label class="form-label">Foto ${container.children.length + 1}</label>
        <div class="d-flex align-items-start justify-content-between">
            <div class="flex-grow-1 me-1">
                <input class="form-control" type="file" name="fotos[]"  accept="image/*">
            </div>
            <div class="py-1">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removePhotoInput(this, '${modalType}')">
                    <i class='bx bx-x'></i>
                </button>
            </div>
        </div>
    `;
            container.appendChild(newInputGroup);
            updatePhotoLabels(modalType);
        }

        function removePhotoInput(button, modalType) {
            const inputGroup = button.closest('.photo-input-group');
            inputGroup.remove();
            updatePhotoLabels(modalType);
        }

        function updatePhotoLabels(modalType) {
            const photoInputs = document.querySelectorAll(
                `#${modalType}-photo-upload-container .photo-input-group .form-label`);
            photoInputs.forEach((label, index) => {
                label.textContent = `Foto ${index + 1}`;
            });
        }
    </script>
    {{-- <!-- Initialize CKEditor -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace('description');
        });
    </script> --}}
@endsection
