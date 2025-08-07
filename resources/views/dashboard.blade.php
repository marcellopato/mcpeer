@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="mcpeer-gradient rounded-lg shadow-xl mb-8 text-center py-16">
            <div class="hero-animation mb-6">
                <img src="{{ asset('images/logo-icon.svg') }}" alt="MCPeer Logo" class="h-16 mx-auto filter brightness-0">
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                Bem-vindo ao MCPeer!
            </h1>
            <p class="text-lg text-gray-700 mb-6 max-w-2xl mx-auto">
                Sua plataforma para criar e gerenciar <strong>servidores Model Context Protocol (MCP)</strong> de forma visual e intuitiva.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('mcp.servers') }}" class="mcpeer-btn-secondary">
                    Começar Agora
                </a>
                <a href="#stats" class="mcpeer-btn-outline">
                    Ver Status
                </a>
            </div>
        </div>
            
        <!-- Stats Cards -->
        <div id="stats" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- MCP Actions Card -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="mcpeer-icon-bg-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['mcp_actions'] }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">MCP Actions</div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('mcp.servers') }}" class="text-yellow-600 dark:text-yellow-400 text-sm font-medium hover:underline transition-colors">
                        Criar primeira ação →
                    </a>
                </div>
            </div>
            
            <!-- Active Servers Card -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-400 rounded-lg flex items-center justify-center text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['active_servers'] }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Servidores Ativos</div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('mcp.servers') }}" class="text-yellow-600 dark:text-yellow-400 text-sm font-medium hover:underline transition-colors">
                        Ver servidores →
                    </a>
                </div>
            </div>
            
            <!-- API Integrations Card -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-400 rounded-lg flex items-center justify-center text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['integrations'] }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Integrações</div>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-gray-400 text-sm font-medium">
                        Em breve →
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="mcpeer-card p-6 mb-8">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Ações Rápidas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('mcp.servers') }}" 
                   class="mcpeer-card-simple border-2 border-dashed border-yellow-300 dark:border-yellow-600 hover:border-yellow-500 dark:hover:border-yellow-400 transition-all duration-200 hover:shadow-md">
                    <div class="text-center">
                        <div class="mcpeer-icon-bg mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h4 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Nova Ação MCP</h4>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Criar uma nova ação para seu servidor MCP</p>
                    </div>
                </a>
                
                <a href="{{ route('mcp.servers') }}" 
                   class="mcpeer-card-simple border-2 border-dashed border-yellow-300 dark:border-yellow-600 hover:border-yellow-500 dark:hover:border-yellow-400 transition-all duration-200 hover:shadow-md">
                    <div class="text-center">
                        <div class="mcpeer-icon-bg mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                            </svg>
                        </div>
                        <h4 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Novo Servidor</h4>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Configurar um novo servidor MCP</p>
                    </div>
                </a>
                
                <div class="mcpeer-card-simple border-2 border-dashed border-gray-300 dark:border-gray-600 opacity-50">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-500 dark:text-gray-400 mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h4 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Documentação</h4>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Em breve - Guias e exemplos</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="mcpeer-card p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Atividade Recente</h3>
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="mcpeer-icon-bg-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Sistema iniciado</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">MCPeer foi iniciado com sucesso</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Agora
                    </div>
                </div>
                
                <div class="text-center py-8">
                    <div class="text-gray-400 dark:text-gray-500 mb-2">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Mais atividades aparecerão aqui conforme você usar o sistema
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
