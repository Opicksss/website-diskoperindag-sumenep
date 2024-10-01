@extends('layouts.dashboard')

@section('title')
    Admin Pesan {{ ucwords($contact->name) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Contact /</span>
                <span><a href="/contactadmin" class="text-muted"> Pesan dan Saran /</a></span>
                {{ ucwords($contact->name) }}
            </h4>
        </div>
        <div class="row">
            <!-- Information -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body">
                        <h6 class="m-0 fw-bold">Detail Pesan dan Saran {{ ucwords($contact->name) }}</h6>
                        <a class="btn-close " href="/contactadmin"></a>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body py-3">
                        <table>
                            <tr>
                                <td>Pengirim </td>
                                <td> : {{ ucwords($contact->name) }}</td>
                            </tr>
                            <tr>
                                <td>Email </td>
                                <td> : {{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <td>Telfon </td>
                                <td> : {{ $contact->phone }}</td>
                            </tr>
                            <tr>
                                <td>Subjek </td>
                                <td> : {{ $contact->subject }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- proses -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body">
                        <h6 class="m-0 fw-bold">Pesan atau Saran</h6>
                    </div>
                    <div class="card-body py-3">
                        <table>
                            <tr>
                                <td>{{ $contact->message }}</td>
                            </tr>
                        </table>
                    </div>
                    @if (!empty($contact->send))
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body">
                            <h6 class="m-0 fw-bold">Balasan</h6>
                        </div>
                        <div class="card-body py-3">
                            <table>
                                <tr>
                                    <td>{{ $contact->send }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body">
                        <h6 class="m-0 fw-bold">Aksi</h6>
                    </div>
                    <div class="card-body py-3 d-flex align-items-start gap-2 ">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#Modalemail{{ $contact->id }}">
                            <i class="bx bx-send "></i></button>
                        @if (!empty($contact->send))
                            <form id="delete-form-{{ $contact->id }}"
                                action="{{ route('contact.destroy', $contact->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-danger delete-btn"
                                    data-contact-id="{{ $contact->id }}" data-contact-title="{{ $contact->name }}">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Email -->
    <div class="modal fade" id="Modalemail{{ $contact->id }}" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('contact.update', $contact->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Balas Pesan Dari
                            {{ $contact->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="reply_message" class="form-label">Pesan Balasan</label>
                            <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="Submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Email -->
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-contact-id');
                    const bookTitle = this.getAttribute('data-contact-title');
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: `Pesan atau Saran Dari "${bookTitle}" akan dihapus`,
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
