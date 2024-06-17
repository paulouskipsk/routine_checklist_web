
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Base para projetos de software">
    <meta name="author" content="Everton Paulouski">

    <title>Routine</title>

    <!-- Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">

    <script src="{{ asset('vendors/template/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendors/template/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('vendors/template/assets/js/config.js') }}"></script>

    <!-- Stylesheets -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet"> --}}

    <link href="{{ asset('fonts/merriweather/merriweather.css') }}" type="text/css" rel="stylesheet">

    <link href="{{ asset('vendors/template/vendors/simplebar/simplebar.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('vendors/template/assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('vendors/template/assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('vendors/template/assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('vendors/template/assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('vendors/template/vendors/choices/choices.min.css') }}" type="text/css" rel="stylesheet">
    {{-- <link href="{{ asset('vendors/template/vendors/flatpickr/flatpickr.min.css') }}" type="text/css" rel="stylesheet"> --}}


    <link href="{{ asset('css/flatpickr.min.css') }}" type="text/css" rel="stylesheet">


    <script src="{{ asset('vendors/sweetAlert/sweetalert2.all.min.js') }}"></script>
    <link href="{{ asset('vendors/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('vendors/select2/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('vendors/select2/select2-bootstrap-5-theme.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('vendors/duallistbox/bootstrap-duallistbox.css') }}" type="text/css" rel="stylesheet">    


    <link href="{{ asset('css/application.css') }}" type="text/css" rel="stylesheet">
  
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>


<script src="{{ asset('js/echarts.js') }}"></script>


{{-- <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script> --}}

