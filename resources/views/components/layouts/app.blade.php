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
            <div class="flex justify-between items-center h-full">
                <h1 class="font-semibold text-2xl">Insta <span class="text-lime-600">APP</span></h1>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 hover:text-lime-600">
                        <span>{{ Auth::user()->name }}</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="min-h-screen pb-36 pt-16">
        {{ $slot }}
        <div class="fixed bottom-10 bg-white border shadow-2xl rounded-xl  w-96 left-1/2 -translate-x-1/2">
            <div class="grid grid-cols-3 gap-4 h-full p-2">
                <a href="{{ route('beranda') }}"
                    class="flex flex-col gap-2 items-center justify-center  {{ request()->routeIs('beranda') ? 'bg-lime-100 text-lime-600' : 'bg-gray-50' }} border rounded-lg p-2">
                    <i class="ti ti-home text-2xl"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('post.form') }}"
                    class="flex flex-col gap-2 items-center justify-center {{ request()->routeIs('post.form') ? 'bg-lime-100 text-lime-600' : 'bg-gray-50' }} border rounded-lg p-2">
                    <i class="ti ti-plus text-2xl"></i>
                    <span>Posting</span>
                </a>
                <a href="{{ route('profile', ['id' => Auth::user()->id]) }}"
                    class="flex flex-col gap-2 items-center justify-center bg-gray-50  {{ request()->routeIs('profile') ? 'bg-lime-100 text-lime-600' : 'bg-gray-50' }} border rounded-lg p-2">
                    <i class="ti ti-user text-2xl"></i>
                    <span>Profile</span>
                </a>
            </div>
        </div>
    </main>
    @livewireScripts
    @filepondScripts
</body>

</html>