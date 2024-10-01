<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-8">
                <div class="mb-5">
                    <div class="row g-4 justify-content-between">
                        <div class="col-md-6 col-lg-6 col-xl-7">
                            <div class="footer-item">
                                <span href="index.html" class="p-0">
                                    <h3 class="text-white"><img src="../assets1/img/logo3.png" alt="Logo"
                                            class="img-fluid" style="max-width: 50px;">
                                        {{ config('app.name') }} Sumenep</h3>
                                </span>
                                <p class="text-white mb-4">Dinas Koperasi UKM Perdagangan dan Perindustrian Berkomitmen
                                    untuk kemajuan koperasi dan UKM. Hubungi kami untuk informasi lebih lanjut atau
                                    dukungan.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4 ">
                            <div class="footer-item">
                                <h4 class="text-white mb-4">Useful Links</h4>
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown">
                                        <span><i class="fas fa-angle-right me-2"></i> Bidang Koperasi</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('koperasi.kecamatan') }}" class="dropdown-item">Koperasi
                                            Tiap Kecamatan</a>
                                        <a href="{{ route('koperasi.kelompok') }}" class="dropdown-item">koperasi
                                            Tiap Kelompok</a>
                                        <a href="{{ route('koperasi.pengawasan') }}" class="dropdown-item">Kegiatan
                                            Pemeriksaan dan Pengawasan</a>
                                        <a href="{{ route('koperasi.kesehatan') }}" class="dropdown-item">Kegiatan
                                            Pemeriksaan Kesehatan</a>
                                        <a href="{{ route('koperasi.fasilitas') }}" class="dropdown-item">Fasilitas
                                            Pendirian Koperasi</a>
                                        <a href="{{ route('koperasi.penghargaan') }}"
                                            class="dropdown-item">Penghargaan</a>
                                        <a href="{{ route('koperasi.pameran') }}" class="dropdown-item">Pameran</a>
                                    </div>
                                </div>
                                <a href="{{ route('contact.index') }}"><i class="fas fa-angle-right me-2"></i>
                                    Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-5" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="row g-4">
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fas fa-map-marker-alt fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Address</h4>
                                            <p class="mb-0">Jl. Urip Sumoharjo No. 6, Kec. Kota Sumenep, kab.
                                                Sumenep</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fas fa-envelope fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Mail Us</h4>
                                            <p class="mb-0">sumenepdkupp@gmail.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fa fa-phone-alt fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Telephone</h4>
                                            <p class="mb-0">(0328) 662635</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Contact</h4>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" name="name"
                                        placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0" name="email"
                                        placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="phone" class="form-control border-0" name="phone"
                                        placeholder="Phone">
                                    <label for="phone">Your Phone</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" name="subject"
                                        placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control border-0" placeholder="Leave a message here" name="message" style="height: 120px"></textarea>
                                    <label for="message">Message</label>
                                </div>

                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="text-center mb-md-0">
                <span class="text-body ">
                    <span class="border-bottom text-white">
                        Copyright © 2024
                    </span>, Dinas Koperasi UKM Perindustrian dan Perdagangan.
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
