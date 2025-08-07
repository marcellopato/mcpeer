@extends('layouts.app')

@section('title', 'MCP Servers')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold mcpeer-gradient-text">MCP Servers</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Gerencie seus servidores Model Context Protocol</p>
    </div>
    <a href="{{ route('mcp.servers.create') }}" class="mcpeer-btn-primary">
        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Novo Servidor
    </a>
</div>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="mcpeer-icon-bg-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ativos</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">3</p>
                    </div>
                </div>
            </div>
            
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-red-400 rounded-lg flex items-center justify-center text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Inativos</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">1</p>
                    </div>
                </div>
            </div>
            
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-400 rounded-lg flex items-center justify-center text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Actions</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">12</p>
                    </div>
                </div>
            </div>
            
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-400 rounded-lg flex items-center justify-center text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Requests/dia</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">1.2k</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="mcpeer-card p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex-1 max-w-lg">
                    <label for="search" class="sr-only">Buscar servidores</label>
                    <div class="relative">
                        <input type="text" 
                               id="search" 
                               placeholder="Buscar servidores..." 
                               class="mcpeer-input pl-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="flex space-x-4">
                    <select class="mcpeer-select">
                        <option>Todos os status</option>
                        <option>Ativos</option>
                        <option>Inativos</option>
                        <option>Em teste</option>
                    </select>
                    
                    <select class="mcpeer-select">
                        <option>Todas as categorias</option>
                        <option>Produção</option>
                        <option>Desenvolvimento</option>
                        <option>Teste</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Servers List -->
        <div class="space-y-6">
            <!-- Server Card 1 -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="mcpeer-icon-bg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                            </svg>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Servidor Principal</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Servidor MCP para operações principais</p>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="status-online">Online</span>
                                <span class="text-xs text-gray-500">Uptime: 24h 15m</span>
                                <span class="text-xs text-gray-500">5 actions</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button class="text-gray-400 hover:text-yellow-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a1 1 0 01-1-1V9a1 1 0 011-1h1a2 2 0 100-4H4a1 1 0 01-1-1V4a1 1 0 011-1h3a1 1 0 001-1v1z" />
                            </svg>
                        </button>
                        <button class="text-gray-400 hover:text-yellow-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                        <button class="mcpeer-btn-danger text-sm">
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Excluir
                        </button>
                    </div>
                </div>
                
                <!-- Server Details -->
                <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">MCP Actions</h4>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="mcp-action-query">query</span>
                                    <span class="text-sm text-gray-500">get_user_profile</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="mcp-action-mutation">mutation</span>
                                    <span class="text-sm text-gray-500">create_task</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="mcp-action-stream">stream</span>
                                    <span class="text-sm text-gray-500">live_notifications</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Configuração</h4>
                            <div class="mcpeer-code">
                                <div class="text-xs">
                                    <div class="text-yellow-400">host:</div>
                                    <div class="ml-4">localhost:8080</div>
                                    <div class="text-yellow-400 mt-1">transport:</div>
                                    <div class="ml-4">stdio</div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Estatísticas</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Requests hoje:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">247</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Tempo médio:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">45ms</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Taxa de erro:</span>
                                    <span class="text-green-600 font-medium">0.1%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Server Card 2 -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                            </svg>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Servidor de Teste</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ambiente de desenvolvimento e testes</p>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="status-offline">Offline</span>
                                <span class="text-xs text-gray-500">Última conexão: 2h atrás</span>
                                <span class="text-xs text-gray-500">3 actions</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button class="mcpeer-btn-primary text-sm">
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8a1 1 0 001-1V8a1 1 0 00-1-1H8a1 1 0 00-1 1v5a1 1 0 001 1z" />
                            </svg>
                            Iniciar
                        </button>
                        <button class="text-gray-400 hover:text-yellow-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                        <button class="mcpeer-btn-danger text-sm">
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (when no servers) -->
        <!--
        <div class="text-center py-12">
            <div class="mcpeer-icon-bg mx-auto mb-4">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                </svg>
            </div>
            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Nenhum servidor encontrado</h3>
            <p class="mt-1 text-gray-500 dark:text-gray-400">
                Comece criando seu primeiro servidor MCP
            </p>
            <div class="mt-6">
                <a href="{{ route('mcp.servers.create') }}" class="mcpeer-btn-primary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Criar Primeiro Servidor
                </a>
            </div>
        </div>
        -->

    </div>
</div>
@endsection
