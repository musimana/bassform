<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name') }}</title>
    <meta name="description" content="{{ config('metadata.description') }}" inertia />
    <meta name="canonical" content="{{ route('home') }}" inertia />

    <base href="{{ url('/') }}">
    <meta name="robots" content="index, follow" />

    @if(config('metadata.open_graph_image'))
    <!-- Open Graph Image -->
    <meta property="og:image" content="{{ Vite::asset(config('metadata.open_graph_image')) }}" inertia />
    <meta property="og:title" content="{{ config('metadata.title') }}" inertia />
    <meta property="og:description" content="{{ config('metadata.description') }}" inertia />
    <meta property="og:image:width" content="1200" inertia />
    <meta property="og:image:height" content="630" inertia />
    @endif

    @if(config('metadata.author'))
    <meta name="author" content="{{ config('metadata.author') }}" />
    @endif

    <!-- Icons -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>
