@extends('layouts.dashboard')

@section('title')
    Admin Pesan
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Contact /</span> Pesan atau Saran</h4>
        </div>
        <!-- Striped Rows -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Pesan atau Saran Pengunjung</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengirim</th>
                            <th>Email</th>
                            <th>Telfon</th>
                            <th>Subjek</th>
                            <th>Pesan atau Saran</th>
                            <th>Balasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($contacts as $contact)
                            <tr class="{{ !empty($contact->send) ? 'table-success' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ ucwords($contact->name) }}</strong></td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ ucfirst($contact->subject) }}</td>
                                <td>{!!  ucfirst(Str::limit($contact->message, 50)) !!}</td>
                                <td>{!!  ucfirst(Str::limit($contact->send, 50)) !!}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('contact.show', $contact->id) }}"><i
                                                    class="bx bx-show-alt me-1"></i> Show</a>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#Modalemail{{ $contact->id }}">
                                                <i class="bx bx-send me-1"></i> Balas</button>
                                            @if (!empty($contact->send))
                                                <form id="delete-form-{{ $contact->id }}"
                                                    action="{{ route('contact.destroy', $contact->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item text-danger delete-btn"
                                                        data-contact-id="{{ $contact->id }}"
                                                        data-contact-title="{{ ucwords($contact->name) }}">
                                                        <i class="bx bx-trash text-danger me-1"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Email -->
                            <div class="modal fade" id="Modalemail{{ $contact->id }}" data-bs-backdrop="static"
                                tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('contact.update', $contact->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="backDropModalTitle">Balas Pesan Dari
                                                    {{ $contact->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="reply_message" class="form-label">Pesan Balasan</label>
                                                    <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="Submit" class="btn btn-primary">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Modal Email -->
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $contacts->links('layouts.pagination') }}
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>
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
