<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--inicio head-->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<!--fin head-->



<body>

    <!-- inicio footer -->
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>


<!-- Bootstrap 4 -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- AdminLTE App -->
    @stack('scripts')
    @yield('scripts')
    @include('sweetalert::alert')
</body>

</html>
