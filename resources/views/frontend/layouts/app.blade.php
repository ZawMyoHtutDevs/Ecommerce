<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Ku Tha - Medicines and Medical Equipments</title>
    
    
    <!-- Scripts -->
    {{-- {{ asset('assets/') }} --}}
    @yield('style')
    <!-- Styles -->
    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-icons.css') }}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    
    
</head>
<body>
    <div class="body-wrapper">
        <!-- Header START -->
        @include('frontend.layouts.parts.header')
        <!-- Header END -->
        
        <!-- Mobile Header START -->
        @include('frontend.layouts.parts.other_header')
        <!-- Header END -->
        
        
        
        @yield('breadcrumb')
        
        @yield('content')
        <!-- Content  -->
        
        <!-- Footer START -->
        @include('frontend.layouts.parts.footer')
        <!-- Footer END -->
        
        
    </div>
    <!-- Content Wrapper END -->
    
    
    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
    
    <!-- All JS Plugins -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- page js -->
    @yield('script')
    
</body>
</html>
