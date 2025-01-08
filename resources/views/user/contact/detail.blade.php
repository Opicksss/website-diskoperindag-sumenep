@extends('pages.dashboard')

@section('title')
    Detail Contact
@endsection

@section('style')
    <style>
.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
}

.pagination .page-item {
    margin: 0 4px;
}

.pagination .page-link {
    color: #6c757d; /* Warna teks abu-abu */
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid transparent;
    transition: background-color 0.2s, color 0.2s;
}

.pagination .page-item.active .page-link {
    background-color: #015FC9; /* Warna ungu untuk halaman aktif */
    color: #fff; /* Warna teks putih untuk halaman aktif */
}

.pagination .page-link:hover {
    background-color: #e2e8f0; /* Warna abu-abu muda saat hover */
}

.pagination .page-item.disabled .page-link {
    color: #dee2e6;
}

/* Tambahan untuk simbol « dan » agar terlihat lebih mirip */
.pagination .page-link:first-child,
.pagination .page-link:last-child {
    padding: 8px 12px;
    color: #015FC9;
    font-weight: bold;
}

    </style>
@endsection

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">CONTACT US</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Contact</a></li>
                <li class="breadcrumb-item active text-white-50">Detail</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->
    <!-- Contact Start -->
    <div class="container-fluid contact bg-light py-2">
        <div class="container py-5">
            <div class="text-center mx-auto pb-2 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 1000px;">
                <h1 class="display-4 ">Berikut adalah pertanyaan dan saran yang sering diajukan</h1>
            </div>
            <div class="row g-5">
                <!-- FAQs Start -->
                <div class="container-fluid faq-section bg-light">
                    <div class="container py-3">
                        <div class="row g-5 align-items-center">
                            <div class="col-xl-12 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="h-100">
                                    <div class="accordion" id="accordionExample">
                                        @foreach ($faqs as $index => $faq)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $index }}">
                                                    <button
                                                        class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} border-0"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $index }}"
                                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                        aria-controls="collapse{{ $index }}">
                                                        Q: {{ $faq->message }}?
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $index }}"
                                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                    aria-labelledby="heading{{ $index }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body rounded">
                                                        A: {{ $faq->send }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Link Pagination -->
                                    <div class="mt-4">
                                        {{ $faqs->links() }} <!-- Menampilkan link pagination -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FAQs End -->


            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
