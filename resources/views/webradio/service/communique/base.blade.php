
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth" >
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @viteReactRefresh
    @vite(['resources/css/app.css',
    'resources/ts/index.ts',
    "resources/ts/htmx.ts",
    "resources/webradio_frontend/home/homeComponents.tsx",
    "resources/webradio_frontend/shared/ScrollToComponent.tsx",
    'resources/webradio_frontend/service/ProgrammeDateComponent.tsx',
    'resources/webradio_frontend/shared/ToastComponent.tsx',

    
    ])

</head>
<body>
    
    @include('webradio.shared.header')
    
    @yield('content')

    <scroll-to></scroll-to>

    @include('webradio.shared.footer')
</body>
</html>