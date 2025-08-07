<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'MCPeer') - {{ config('app.name', 'MCPeer') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    
    <!-- Alpine.js for interactive components -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased h-full bg-gray-50 dark:bg-gray-900 dark-mode-transition" 
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches) }" 
      x-init="$watch('darkMode', value => localStorage.setItem('darkMode', value))" 
      :class="{ 'dark': darkMode }">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center space-x-3">
                            <img src="{{ asset('images/logo-icon.svg') }}" alt="MCPeer" class="h-8 w-8">
                            <span class="text-xl font-bold mcpeer-gradient-text">MCPeer</span>
                        </div>
                        
                        <!-- Navigation Links -->
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <a href="{{ route('dashboard') }}" 
                               class="@if(request()->routeIs('dashboard')) mcpeer-nav-active @else mcpeer-nav-inactive @endif border-b-2 px-1 pt-1 text-sm font-medium transition-all">
                                Dashboard
                            </a>
                            <a href="{{ route('mcp.servers') }}" 
                               class="@if(request()->routeIs('actions.*') || request()->routeIs('mcp.*')) mcpeer-nav-active @else mcpeer-nav-inactive @endif border-b-2 px-1 pt-1 text-sm font-medium transition-all">
                                MCP Manager
                            </a>
                            <a href="{{ route('servers.index') }}" 
                               class="@if(request()->routeIs('servers.*')) mcpeer-nav-active @else mcpeer-nav-inactive @endif border-b-2 px-1 pt-1 text-sm font-medium transition-all">
                                API
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right side -->
                    <div class="flex items-center space-x-4">
                        <!-- Theme Toggle -->
                        <button @click="darkMode = !darkMode" 
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 rounded-lg transition-colors">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                            </svg>
                            <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 716.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </button>
                        
                        <!-- User Menu (future implementation) -->
                        <div class="hidden md:block">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Admin
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <main class="flex-1">
            @hasSection('header')
                <header class="bg-white dark:bg-gray-800 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif
            
            @yield('content')
        </main>
    </div>

    @livewireScripts
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
