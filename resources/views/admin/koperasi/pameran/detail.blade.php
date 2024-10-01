@extends('layouts.dashboard')

@section('title')
    Admin Pameran {{ ucwords($pameran->title) }}
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
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Koperasi /</span>
                <span><a href="/adminpameran" class="text-muted"> Pameran /</a></span>
                {{ ucwords($pameran->title) }}
            </h4>
        </div>
        <div class="row">
            <!-- Cover Image -->
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if ($pameran->fotos->isEmpty())
                            <img class="card-img-top" src="{{ asset('img/cover.png') }}" alt="Card image cap">
                        @else
                            @foreach ($pameran->fotos as $foto)
                                <div class="py-2">
                                    <img class="card-img-top" src="/storage/{{ $foto->foto }}" alt="Card image cap">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- Information -->
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body">
                        <h6 class="m-0 fw-bold">Detail Pameran {{ ucwords($pameran->title) }}</h6>
                        <a class="btn-close " href="/adminpameran"></a>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body py-3">
                        <table>
                            <tr>
                                <td>Nama </td>
                                <td> : {{ ucwords($pameran->title) }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal </td>
                                <td> : {{ date('d-m-Y', strtotime($pameran->tanggal)) }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- proses -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body">
                        <h6 class="m-0 fw-bold">Deskripsi</h6>
                    </div>
                    <div class="card-body py-3">
                        <table>
                            <tr>
                                <td>{!! $pameran->description !!}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body">
                        <h6 class="m-0 fw-bold">Aksi</h6>
                    </div>
                    <div class="card-body py-3 d-flex align-items-start gap-2 ">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#ModalEdit{{ $pameran->id }}">
                            <i class="bx bx-edit-alt "></i></button>
                        <form id="delete-form-{{ $pameran->id }}"
                            action="{{ route('adminpameran.destroy', $pameran->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-danger delete-btn"
                                data-pameran-id="{{ $pameran->id }}"
                                data-pameran-title="{{ $pameran->title }}">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEdit{{ $pameran->id }}" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl" role="document"">
            <div class="modal-content">
                <form action="{{ route('adminpameran.update', $pameran->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Edit Pameran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col mb-3">
                                <label for="title" class="form-label">Judul</small></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $pameran->title }}" required>
                            </div>
                            <div class="col mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="{{ $pameran->tanggal }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" rows="7" name="description" required>{{ $pameran->description }}</textarea>
                        </div>
                        @if ($pameran->fotos->isEmpty())
                        @else
                            <div class="mb-3">
                                <label for="description">Foto Saat Ini</label>
                                <div class="photo-container ">
                                    @foreach ($pameran->fotos as $foto)
                                        <div class="photo-item">
                                            <img src="/storage/{{ $foto->foto }}" alt="Foto">
                                            <div class="checkbox-wrapper">
                                                <input type="checkbox" class="form-check-input me-1" name="remove_fotos[]"
                                                    value="{{ $foto->id }}">
                                                <label class="mt-2">Hapus</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="mb-3" id="edit-photo-upload-container">
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                            onclick="addPhotoInput('edit')"><i class="bx bx-plus"></i>
                            FOTO</button>
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
    </div>
    <!-- /Modal Edit -->
@endsection

@section('script')
    <script>
            document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-pameran-id');
                    const bookTitle = this.getAttribute('data-pameran-title');
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: `Data Pameran Dengan Judul "${bookTitle}" akan dihapus`,
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
@endsection
