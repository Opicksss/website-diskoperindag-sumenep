<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <img src="../assets1/img/logo3.png" alt="Logo" class="img-fluid" style="max-width: 35px;">
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2"> {{ config('app.name') }} </span>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Sidebar untuk Admin atau Peran Lain -->
        <li class="menu-item {{ \Route::is('dashboard.*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Bidang Koperasi</span>
        </li>

        <!-- sidebar 1 -->
        {{-- <li class="menu-item {{ \Route::is('adminkoperasikecamatan.*') ? 'active' : '' }}">
            <a href="{{ route('adminkoperasikecamatan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-building-house"></i>
                <div data-i18n="Analytics">Kop Tiap Kecamatan</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('adminkoperasikelompok.*') ? 'active' : '' }}">
            <a href="{{ route('adminkoperasikelompok.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-building"></i>
                <div data-i18n="Analytics">Kop Tiap Kelompok</div>
            </a>
        </li> --}}
        <!-- //sidebar 1 -->

        <!-- sidebar 2 -->
        <li class="menu-item {{ \Route::is('categorykecamatan.*') || \Route::is('adminkecamatan.*') ? 'active' : '' }}">
            <a href="{{ route('categorykecamatan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-building-house"></i>
                <div data-i18n="Analytics">Kop Tiap Kecamatan</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('categorykelompok.*') || \Route::is('adminkelompok.*') ? 'active' : '' }}">
            <a href="{{ route('categorykelompok.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-building"></i>
                <div data-i18n="Analytics">Kop Tiap Kelompok</div>
            </a>
        </li>
        <!-- //sidebar 2 -->

        <li class="menu-item {{ \Route::is('adminpengawasan.*') ? 'active' : '' }}">
            <a href="{{ route('adminpengawasan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-cctv"></i>
                <div data-i18n="Analytics">Pengawasan</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('adminkesehatan.*') ? 'active' : '' }}">
            <a href="{{ route('adminkesehatan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-plus-medical"></i>
                <div data-i18n="Analytics">Kesehatan</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('adminfasilitas.*') ? 'active' : '' }}">
            <a href="{{ route('adminfasilitas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-factory"></i>
                <div data-i18n="Analytics">Fasilitas</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('adminpenghargaan.*') ? 'active' : '' }}">
            <a href="{{ route('adminpenghargaan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-trophy"></i>
                <div data-i18n="Analytics">Penghargaan</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('adminpameran.*') ? 'active' : '' }}">
            <a href="{{ route('adminpameran.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-collection"></i>
                <div data-i18n="Analytics">Pameran</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Contact</span>
        </li>
        <li class="menu-item {{ \Route::is('contact.*') ? 'active' : '' }}">
            <a href="{{ route('contact.admin') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-collection"></i>
                <div data-i18n="Analytics">Pesan atau Saran</div>
            </a>
        </li>
    </ul>
    <!-- Layouts -->
</aside>
