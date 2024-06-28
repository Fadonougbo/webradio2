<!DOCTYPE html>
<html lang="fr" class="scroll-smooth" >
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    
    <link rel="icon" href="{{asset('images/rtulogo1.jpg')}}">
    <!-- font  -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> -->

    @viteReactRefresh
    @vite(['resources/css/app.css',
            'resources/ts/index.ts',
            "resources/webradio_frontend/home/homeComponents.tsx",
            "resources/webradio_frontend/shared/ScrollToComponent.tsx",
            'resources/ts/htmx.ts'
            ])
    @yield('specifique_resource')

  <style>
      

     /*  body {
        font-family: "Roboto", sans-serif;
        font-weight: 100;
        font-style: normal;
        }

        body {
        font-family: "Roboto", sans-serif;
        font-weight: 300;
        font-style: normal;
        }

        body {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-style: normal;
        }

       body {
        font-family: "Roboto", sans-serif;
        font-weight: 500;
        font-style: normal;
        }

        body {
        font-family: "Roboto", sans-serif;
        font-weight: 700;
        font-style: normal;
        }

        body {
        font-family: "Roboto", sans-serif;
        font-weight: 900;
        font-style: normal;
        } */








  </style>

</head>

<body>
    
    @include('webradio.shared.header')
    
    @include('webradio.shared.content_loader')

    @yield('content')

    <scroll-to></scroll-to>

    @include('webradio.shared.footer')
</body>
</html>