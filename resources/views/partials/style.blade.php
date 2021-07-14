<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

   <!-- Fontfaces CSS-->
    <link href="{{{ URL::asset('template/css/font-face.css') }}}" rel="stylesheet" media="all">
    <link href="{{{ URL::asset('template/vendor/font-awesome-4.7/css/font-awesome.min.css')}}}" rel="stylesheet" media="all">
    <link href="{{{ URL::asset('template/vendor/font-awesome-5/css/fontawesome-all.min.css')}}}" rel="stylesheet" media="all">
    <link href="{{{ URL::asset('template/vendor/mdi-font/css/material-design-iconic-font.min.css')}}}" rel="stylesheet" media="all">
 
    <!-- Bootstrap CSS-->
    <link href="{{{ URL::asset('template/vendor/bootstrap-4.1/bootstrap.min.css')}}}" rel="stylesheet" media="all">
 
    <link href="{{{ URL::asset('template/vendor/animsition/animsition.min.css')}}}" rel="stylesheet" media="all">
 
    <!-- Main CSS-->
    <link href="{{{ URL::asset('template/css/theme.css')}}}" rel="stylesheet" media="all">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- Main CSS-->
    <link href="{{{ URL::asset('template/css/theme.css')}}}" rel="stylesheet" media="all">

    {{-- UPDATE CSS --}}
    <link href="{{{ URL::asset('assets/sweetalert2/dist/sweetalert2.min.css')}}}" rel="stylesheet" media="all">
    <link href="{{{ URL::asset('assets/datatables/datatables.min.css')}}}" rel="stylesheet" media="all">
    
    @yield('custom_styles')
</head>