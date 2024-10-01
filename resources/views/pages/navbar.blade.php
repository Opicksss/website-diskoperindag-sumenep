        <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <span href="#" class="navbar-brand p-0">
                        <h1 class="text-primary mb-0"><img src="../assets1/img/logo3.png" alt="Logo">
                            <strong>{{ config('app.name') }}</strong>
                        </h1>
                    </span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-0 mx-lg-auto">
                            <a href="/"
                                class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                            <div
                                class="nav-item dropdown {{ \Route::is('koperasi.*') || \Route::is('show.*') ? 'active' : '' }}">
                                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                    <span class="dropdown-toggle">Bidang Koperasi</span>
                                </a>
                                <div class="dropdown-menu">

                                    <!-- navbar 1 -->
                                    <a href="{{ route('koperasi.kecamatan') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.kecamatan') ? 'active' : '' }}">Koperasi
                                        Tiap Kecamatan</a>
                                    <a href="{{ route('koperasi.kelompok') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.kelompok') ? 'active' : '' }}">koperasi
                                        Tiap Kelompok</a>
                                    <!-- //navbar 1 -->

                                    <!-- navbar 2 -->
                                    <a href="{{ route('koperasi.categorykecamatan') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.categorykecamatan') || \Route::is('koperasi.kopkecamatan') ? 'active' : '' }}">Koperasi
                                        Tiap Kecamatan</a>
                                    <a href="{{ route('koperasi.categorykelompok') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.categorykelompok') || \Route::is('koperasi.kopkelompok') ? 'active' : '' }}">koperasi
                                        Tiap Kelompok</a>
                                    <!-- //navbar 2 -->
                                    
                                    <a href="{{ route('koperasi.pengawasan') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.pengawasan') || \Route::is('show.pengawasan') ? 'active' : '' }}">Kegiatan
                                        Pemeriksaan dan Pengawasan</a>
                                    <a href="{{ route('koperasi.kesehatan') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.kesehatan') || \Route::is('show.kesehatan') ? 'active' : '' }}">Kegiatan
                                        Pemeriksaan Kesehatan</a>
                                    <a href="{{ route('koperasi.fasilitas') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.fasilitas') || \Route::is('show.fasilitas') ? 'active' : '' }}">Fasilitas
                                        Pendirian Koperasi</a>
                                    <a href="{{ route('koperasi.penghargaan') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.penghargaan') || \Route::is('show.penghargaan') ? 'active' : '' }}">Penghargaan</a>
                                    <a href="{{ route('koperasi.pameran') }}"
                                        class="dropdown-item {{ \Route::is('koperasi.pameran') || \Route::is('show.pameran') ? 'active' : '' }}">Pameran</a>
                                </div>
                            </div>
                            <a href="{{ route('contact.index') }}"
                                class="nav-item nav-link {{ \Route::is('contact.*') ? 'active' : '' }}">Contact</a>
                            <div class="nav-btn px-3">
                                <button class="btn-search btn btn-primary btn-md-square rounded-circle flex-shrink-0"
                                    data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Modal Search Start -->
        <form method="GET" action="">
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-3"
                        style="position: relative; background-color: rgba(255, 255, 255, 0.3); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.3);">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex align-items-center">
                            <div class="input-group w-75 mx-auto d-flex">
                                <input type="text" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1" name="Search">
                                <span id="search-icon-1" class="btn bg-light border input-group-text p-3"><i
                                        class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Modal Search End -->
