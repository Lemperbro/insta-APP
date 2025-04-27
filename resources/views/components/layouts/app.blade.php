<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme({ default: 'light' })">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css" />


    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Page Title' }}</title>

    <style>
        .sidebar-transition {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .sidebar-hidden {
            transform: translateX(-100%);
            opacity: 0;
        }

        .sidebar-visible {
            transform: translateX(0);
            opacity: 1;
        }

        .content-transition {
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .content-full {
            margin-left: 0 !important;
            width: 100% !important;
        }

        .content-full-header {
            padding-left: 0 !important;
            width: 100% !important;
        }
    </style>
</head>

<body class="font-poppins" x-data="{
        sidebarHidden: window.innerWidth < 1024, 
        checkScreenSize() {
            this.sidebarHidden = window.innerWidth < 1024;
        }
    }" x-init="checkScreenSize(); window.addEventListener('resize', checkScreenSize)"
    x-bind:class="{ 'dark bg-[var(--main-bg)]': darkTheme, 'bg-gray-50': !darkTheme }">
    <x-ts-toast />
    <x-ts-dialog />

    <div class="fixed top-0 left-0 right-0 h-16 bg-white z-40">
        <div class="container h-full">
            <div class="flex flex-col h-full justify-center">
                <h1 class="font-semibold text-2xl">Insta <span class="text-lime-600">APP</span> </h1>
            </div>
        </div>
    </div>

    <main class="min-h-screen pb-36 pt-16">
        {{ $slot }}
        <div class="fixed bottom-10 bg-white border shadow-2xl rounded-xl  w-96 left-1/2 -translate-x-1/2">
            <div class="grid grid-cols-3 gap-4 h-full p-2">
                <div class="flex flex-col gap-2 items-center justify-center bg-gray-50 border rounded-lg p-2">
                    <i class="ti ti-home text-2xl"></i>
                    <span>Beranda</span>
                </div>
                <a href="{{ route('post.form') }}"
                    class="flex flex-col gap-2 items-center justify-center bg-gray-50 border rounded-lg p-2">
                    <i class="ti ti-plus text-2xl"></i>
                    <span>Posting</span>
                </a>
                <div class="flex flex-col gap-2 items-center justify-center bg-gray-50 border rounded-lg p-2">
                    <i class="ti ti-user text-2xl"></i>
                    <span>Profile</span>
                </div>
            </div>
        </div>
    </main>
    @livewireScripts
    @filepondScripts
</body>

</html>