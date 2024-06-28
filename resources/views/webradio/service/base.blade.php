<!DOCTYPE html>
<html lang="en" class="scroll-smooth" >
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="icon" href="{{asset('images/rtulogo1.jpg')}}">

    @viteReactRefresh
    @vite(['resources/css/app.css','resources/ts/index.ts',"resources/webradio_frontend/home/homeComponents.tsx","resources/webradio_frontend/shared/ScrollToComponent.tsx"])
</head>
<body>
    
    @include('webradio.shared.header')
    
    @yield('content')

    <scroll-to></scroll-to>

    @include('webradio.shared.footer')
</body>
</html>