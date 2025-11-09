<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WE-Kasir') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-gray-900 via-gray-900 to-gray-800 text-white flex-shrink-0 shadow-2xl">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1
                            class="text-xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                            Web Kasir</h1>
                        <p class="text-xs text-gray-400">Point of Sale System</p>
                    </div>
                </div>
            </div>

            <nav class="mt-6 px-3 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg shadow-blue-500/50' : 'hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                @if(auth()->user()->role === 'kasir' || auth()->user()->role === 'admin')
                    <!-- Transaksi -->
                    <a href="{{ route('transactions.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg shadow-blue-500/50' : 'hover:bg-gray-800/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="font-medium">Transaksi</span>
                    </a>
                @endif

                @if(auth()->user()->role === 'admin')
                    <!-- Produk -->
                    <a href="{{ route('products.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg shadow-blue-500/50' : 'hover:bg-gray-800/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span class="font-medium">Produk</span>
                    </a>

                    <!-- Kategori -->
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('categories.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg shadow-blue-500/50' : 'hover:bg-gray-800/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span class="font-medium">Kategori</span>
                    </a>
                @endif

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manajer')
                    <!-- Kelola Stok -->
                    <a href="{{ route('stock.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('stock.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg shadow-blue-500/50' : 'hover:bg-gray-800/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                        <span class="font-medium">Kelola Stok</span>
                    </a>

                    <!-- Laporan -->
                    <a href="{{ route('reports.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg shadow-blue-500/50' : 'hover:bg-gray-800/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Laporan</span>
                    </a>
                @endif

                <!-- Riwayat Transaksi -->
                <a href="{{ route('transactions.history') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('transactions.history') ? 'bg-gradient-to-r from-blue-600 to-blue-500 shadow-lg shadow-blue-500/50' : 'hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Riwayat</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 w-64 p-4 bg-gradient-to-r from-gray-800 to-gray-900 border-t border-gray-700">
                <div class="flex items-center space-x-3 mb-3">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg ring-2 ring-blue-400/30">
                        <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400 capitalize flex items-center">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5"></span>
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center px-4 py-2 bg-gray-700/50 hover:bg-red-500/20 text-gray-300 hover:text-red-400 rounded-lg transition-all duration-200 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 shadow-sm">
                <div class="px-8 py-5">
                    <h2 class="text-2xl font-bold text-gray-900">
                        @yield('page-title')</h2>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-8">
                @if(session('success'))
                    <div
                        class="mb-6 bg-blue-50 border-l-4 border-blue-500 text-blue-700 px-6 py-4 rounded-xl shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        @stack('scripts')
</body>

</html>