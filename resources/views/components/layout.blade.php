<!doctype html>

<head>
    <title>Aurified: {{ $title }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Aurified is a social media platform for Gold Mining & Prospecting.">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://kit.fontawesome.com/d24a02256d.js" crossorigin="anonymous"></script>
</head>

<body style="font-family: Open Sans, sans-serif">

<section class="px-4 py-4">
    <nav class="md:flex md:justify-between rounded-xl py-4 px-8 bg-gray-100 md:items-center">
        <div>
            <a href="/">
                <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>

        <div class="mt-8 md:mt-0 flex items-center">
            @guest
                <div class="">
                    <a href="{{ route('login') }}"
                       class="text-xs font-bold uppercase">Login</a>
                </div>
                <div class="ml-4">
                    <a href="{{ route('register') }}"
                       class="text-xs font-bold uppercase">Register</a>
                </div>
            @endguest
            @auth
                <x-dropdown>
                    <x-slot name="trigger">
                        <button
                            class="text-xs font-bold uppercase text-xs py-3 px-3">
                            Welcome, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}!
                        </button>
                    </x-slot>

                    @if (auth()->user()->can('admin'))
                        @admin
                        <x-dropdown-item href="/admin/posts" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-dropdown-item>
                        <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">
                            New Post
                        </x-dropdown-item>
                        @endadmin
                    @endif
                    <x-dropdown-item href="#"
                                     x-data="{}"
                                     class="border-t-4 border-gray-300"
                                     :active="request()->routeIs('logout')"
                                     @click.prevent="document.querySelector('#logout-form').submit()">Log Out
                    </x-dropdown-item>
                </x-dropdown>

                <form id="logout-form" method='post' action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            @endauth
            <a href="#newsletter"
               class="bg-blue-500 text-xs font-semibold text-white scroll-smooth uppercase py-3 px-5 rounded-full ml-3">
                Subscribe for Updates
            </a>
        </div>
    </nav>

    {{ $slot }}
    @authv
    <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative h-11 inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="{{ route('newsletter') }}" class="lg:flex text-sm">
                    @csrf
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <input id="newsletter"
                               name="email"
                               type="text"
                               placeholder="Your email address"
                               class="lg:bg-transparent border-0 py-2 lg:py-0 pl-4 focus-within:outline-none">
                    </div>
                    @error('email')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror

                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                    >
                        Subscribe
                    </button>
                </form>
                </div>
            </div>
    </footer>
    @endauthv
</section>

@if (session()->has('error'))
    @php
        $colour = "fixed bg-red-500";
        $position = "bottom-5 right-5";
    @endphp
    <x-flash-message type="error" :colour="$colour" :position="$position" :message="session('error')"/>
@endif


@if (session()->has('alert'))
    @php
        $colour = "fixed bg-yellow-500";
        $position = "bottom-5 right-5";
    @endphp
    <x-flash-message type="alert" :colour="$colour" :position="$position" :message="session('alert')"/>
@endif

@if (session()->has('success'))
    @php
        $colour = "fixed bg-blue-500";
        $position = "bottom-5 right-5";
    @endphp
    <x-flash-message type="success" :colour="$colour" :position="$position" :message="session('success')"/>
@endif

</body>

