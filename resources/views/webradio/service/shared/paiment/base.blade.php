@use('Illuminate\Support\Facades\Vite')

<!DOCTYPE html>
<html lang="en" class="scroll-smooth" >
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @viteReactRefresh
    @vite(['resources/css/app.css',
    'resources/ts/index.ts',
    'resources/webradio_frontend/service/PaimentComponent.tsx'
    ])

</head>
<body>
        
    @yield('content')
    

</body>
</html>