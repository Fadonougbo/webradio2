<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard</title>
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.js','resources/webradio_frontend/shared/ToastComponent.tsx','resources/ts/index.ts','resources/webradio_frontend/shared/DeleteButton.ts'])
        <!-- 'resources/ts/htmx.ts' -->
        @if (request()->routeIs('dashboard.configuration'))
            @vite(['resources/ts/htmx.ts','resources/css/role_loader.css'])
        @endif

        @if (request()->routeIs('dashboard.blog.create.article'))
            @vite(['resources/webradio_frontend/blog/EditorComponent.tsx','resources/ts/htmx.ts'])
        @endif

        @if (request()->routeIs('dashboard.blog.update.article'))
            @vite(['resources/webradio_frontend/blog/EditorComponent.tsx','resources/ts/htmx.ts'])
        @endif

        @if (request()->routeIs('dashboard.blog.index'))
            @vite(['resources/webradio_frontend/blog/removeEditorItem.ts'])
        @endif
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
