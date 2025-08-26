<!doctype html>

<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../"
  data-template="horizontal-menu-template-no-customizer"
  data-bs-theme="light">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RealRentCar') }}</title>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('flatpickr::components.style')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        html {
            scroll-behavior: smooth;
        }


    </style>

<style>
    /* Personnalisation du bouton de confirmation en rouge (identique à la croix 'X') */
    .swal2-confirm.swal2-confirm-red {
        background-color: #d33 !important;  /* Le même rouge utilisé pour la croix 'X' */
        border-color: #d33 !important;  /* Même couleur pour la bordure */
        color: white !important;  /* Texte blanc */
    }
    .selected-row {
    background-color: #fefcbf; /* Jaune clair */
    color: #2d3748;           /* Couleur du texte */
    font-weight: bold;        /* Texte en gras */
}

.selected-row:hover {
    background-color: #faf089; /* Jaune plus foncé au survol */
}

</style>


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    />


    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: Dashboard - Analytics | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('../../img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

   <!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('../../img/favicon/favicon.ico') }}" />

<!-- Icon Fonts -->
<link rel="stylesheet" href="{{ asset('../../vendor/fonts/iconify-icons.css') }}" />

<!-- Core CSS -->
<!-- build:css ../../assets/vendor/css/theme.css -->
<link rel="stylesheet" href="{{ asset('../../vendor/libs/node-waves/node-waves.css') }}" />
<link rel="stylesheet" href="{{ asset('../../vendor/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('../../css/demo.css') }}" />
<!-- endbuild -->

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('../../vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('../../vendor/libs/apex-charts/apex-charts.css') }}" />
<link rel="stylesheet" href="{{ asset('../../vendor/libs/swiper/swiper.css') }}" />
<link rel="stylesheet" href="{{ asset('../../vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('../../vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('../../vendor/fonts/flag-icons.css') }}" />

<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('../../vendor/css/pages/cards-advance.css') }}" />

<!-- Helpers -->
<script src="{{ asset('../../vendor/js/helpers.js') }}"></script>

<!-- Theme Config -->
<script src="{{ asset('../../js/config.js') }}"></script>
<!-- Bootstrap CSS (déjà présent sûrement) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (inclut Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->

       @include('admin.partials.navbar')

        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Menu -->
           @include('admin.partials.menu')
            <!-- / Menu -->

            <!-- Content -->
           @yield('content')
            <!--/ Content -->

            <!-- Footer -->
           @include('admin.partials.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!--/ Content wrapper -->
        </div>

        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

<!-- Vendor JS -->
<script src="{{ asset('../../vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('../../vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('../../vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('../../vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('../../vendor/libs/@algolia/autocomplete-js.js') }}"></script>
<script src="{{ asset('../../vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('../../vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('../../vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('../../vendor/js/menu.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('../../vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('../../vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('../../vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('../../js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('../../js/dashboards-analytics.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
<link href=".../custom.css" rel="stylesheet">
<script src=".../some-js.js"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
@include('flatpickr::components.script')
@stack('scripts')
  </body>

</html>
