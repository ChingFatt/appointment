<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{ config('app.name') }} - Admin</title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/oneui.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('/css/main.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/amethyst.css') }}"> -->
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <div id="page-loader" class="show"></div>
        <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-overlay-hover side-scroll page-header-fixed main-content-narrow">
            @yield('aside')
            <x-layout.admin.sidebar/>
            <x-layout.admin.header/>
            
            <main id="main-container">
                <div class="bg-body-light">
                    @if (Route::currentRouteName() != 'admin.dashboard.index')
                    <x-layout.admin.breadcrumb/>
                    @endif
                </div>
                @yield('content')
            </main>

            <x-layout.admin.footer/>
        </div>
        <!-- END Page Container -->
        
        <!-- OneUI Core JS -->
        <script src="{{ mix('js/oneui.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ mix('/js/laravel.app.js') }}"></script>

        @stack('js_before')
        @yield('js_after')
        <script>
            jQuery(function () {
                One.helpers(['maxlength', 'select2', 'datepicker', 'fullcalendar','sparkline', 'table-tools-checkable']);
            });
            jQuery('.modal').on('hidden.bs.modal', function () {
                jQuery('.modal form')[0].reset();
                jQuery(this).find('.is-invalid').removeClass('is-invalid');
                //jQuery('.invalid-feedback').remove();
                jQuery(this).validate().resetForm();
            });
            jQuery('.js-select2').on('change', function(){
                //alert('changed');
            })
        </script>
        @stack('scripts')
    </body>
</html>
