@extends('layouts.dashboard')

@section('title')
    Profile
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4">Profile</h4>
        </div>

        <!-- Striped Rows -->
        <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <form id="uploadForm" action="{{ route('profile.upload', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @if ($user->pp)
                            <img class="d-block rounded" src="/storage/{{ $user->pp }}" alt="user-avatar" height="100"
                                width="100" id="uploadedAvatar">
                        @else
                            <img class="d-block rounded" src="{{ asset('img/profilDefault.jpg') }}" alt="user-avatar"
                                height="100" width="100" id="uploadedAvatar">
                        @endif
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" name="pp" hidden
                                    accept="image/png, image/jpeg">
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4"
                                id="resetButton">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 1000K</p>
                        </div>
                    </div>
                </div>
            </form>

            <hr class="my-0">
            <div class="card-body">
                <form method="post" action="{{ route('profile.update', $user->id) }}" class="mt-6 space-y-6" novalidate>
                    @csrf
                    @method('put')
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}"
                            required autofocus>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}"
                            required readonly>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        <div class="card mb-4">
            <h5 class="card-header">Change Password</h5>
            <!-- Account -->
            <div class="card-body">
                <form method="post" action="{{ route('profile.password', $user->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label for="password" class="form-label">Current Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="current_password" class="form-control" name="current_password"
                                aria-describedby="password" required>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('current_password')
                            <div class="text-sm text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label for="password" class="form-label">New Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                aria-describedby="password" required>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        <small>Password Minimal 8 Karakter</small>
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label for="password" class="form-label">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirmation" class="form-control"
                                name="password_confirmation" aria-describedby="password" required>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('password')
                            <div class="text-sm text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        <!--/ Striped Rows -->
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('upload').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                document.getElementById('uploadForm').submit();
            }
        });

        document.getElementById('resetButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Foto profil akan direset.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('profile.reset', ['user' => auth()->user()->id]) }}";

                    let token = document.createElement('input');
                    token.name = '_token';
                    token.value = "{{ csrf_token() }}";
                    token.type = 'hidden';
                    form.appendChild(token);

                    let method = document.createElement('input');
                    method.name = '_method';
                    method.value = 'PUT';
                    method.type = 'hidden';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
@endsection
