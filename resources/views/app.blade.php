<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    @include('partials.head.default')

    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
