<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gray-100 text-gray-900">
        <div class="flex min-h-screen w-full">
            <div class="w-full space-y-6 flex-1 flex flex-col">
                 <!-- Page Heading -->
                <header class="relative top-0 w-full h-24 z-40">
                    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center space-x-2">
                            <div class="flex-none"></div>
                            <div class="flex-1 flex items-center justify-center space-x-4">
                                <img src="{{ asset('images/sprites/voters_box.png') }}" title="My Kodigo 2022" alt="Voters Box" class="inline-block w-10 h-10">
                                <h1 class="text-2xl font-bold leading-tight text-gray-900 hidden md:block">
                                    {{ config('app.name', 'Laravel') }}
                                </h1>
                            </div>
                            <div class="flex-none"></div>
                        </div>
                    </div>
                </header>
                <main class="flex-1 w-full mx-auto">
                    {{ $slot }}
                </main>
                <footer class="relative w-full h-24 z-40">
                    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-center space-y-2">
                            <p class="text-sm text-gray-600">
                                Disclaimer:
                            </p>
                            <p class="text-sm text-gray-600">
                                All data entered are not saved. After leaving the site, all data will be lost.
                            </p>
                            <p class="text-sm text-gray-600">
                                List of candidates came from the <a href="https://comelec.gov.ph/?r=2022NLE/BallotFaceTemplates" class="hover:underline">COMELEC's official website</a>.<br/>
                                Data is valid as of January 28, 2022 and retrieved on March 24, 2022.
                            </p>
                            <p class="text-sm text-gray-600">
                                <a href="https://cmdinglasan.com" class="hover:underline">Christian Dinglasan</a> <span class="text-gray-500">&copy;</span> {{ date('Y') }}. All rights reserved.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        {{-- <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            {{-- <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header> --}}

            <!-- Page Content -->
            {{-- <main>
                {{ $slot }}
            </main> --}}
        {{-- </div> --}}
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 5000,
                timerProgressBar:true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        
            window.addEventListener('alert',({detail:{type,message}})=>{
                Toast.fire({
                    icon:type,
                    title:message
                })
            })
        </script>
    </body>
</html>
