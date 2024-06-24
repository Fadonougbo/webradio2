<!DOCTYPE html>
<html lang="fr" class="scroll-smooth" >
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    
    @viteReactRefresh
    @vite(['resources/css/app.css',
            'resources/ts/index.ts',
            "resources/webradio_frontend/home/homeComponents.tsx",
            "resources/webradio_frontend/shared/ScrollToComponent.tsx",
            'resources/ts/htmx.ts'
            ])
    @yield('specifique_resource')

</head>

<body>
    
    @include('webradio.shared.header')
    
    @yield('content')

    <scroll-to></scroll-to>

    @include('webradio.shared.footer')
</body>
</html>