<!DOCTYPE html>
<html lang="fr" class="scroll-smooth" >
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="icon" href="{{asset('images/rtulogo1.jpg')}}">

    @viteReactRefresh
    @vite(['resources/ts/index.ts',"resources/ts/htmx.ts",'resources/webradio_frontend/service/PaymentComponent.tsx','resources/css/loader.css'])
</head>
<body>

    @yield('content')

</body>
</html>