<!DOCTYPE html>
<html lang="en">

@includeIf('pages.head')

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    @includeIf('pages.topbar')
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    @includeIf('pages.navbar')
    <!-- Navbar & Hero End -->

    @yield('content')

    <!-- Footer Start -->
    @includeIf('pages.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets1/lib/wow/wow.min.js"></script>
    <script src="../assets1/lib/easing/easing.min.js"></script>
    <script src="../assets1/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets1/lib/counterup/counterup.min.js"></script>
    <script src="../assets1/lib/lightbox/js/lightbox.min.js"></script>
    <script src="../assets1/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets1/js/main.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                iziToast.success({
                    title: 'Success',
                    message: '{{ session('success') }}',
                    position: 'topCenter', // Posisi notifikasi (topRight, topLeft, topCenter, bottomRight, bottomLeft, bottomCenter)
                    timeout: 3000 // Durasi tampil notifikasi (dalam milidetik)
                });
            @endif
            @if (session('error'))
                iziToast.error({
                    title: 'Failed',
                    message: '{{ session('error') }}',
                    position: 'topCenter', // Posisi notifikasi (topRight, topLeft, topCenter, bottomRight, bottomLeft, bottomCenter)
                    timeout: 3000 // Durasi tampil notifikasi (dalam milidetik)
                });
            @endif
        });
    </script>


    @yield('script')
</body>

</html>
