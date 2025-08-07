@extends('layouts.app')

@section('title', 'API Servers')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold mcpeer-gradient-text">API Servers</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Gerencie servidores MCP via API REST</p>
    </div>
    <a href="{{ route('servers.create') }}" class="mcpeer-btn-primary">
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
        
        @if(count($servers) > 0)
            <!-- Servers Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($servers as $server)
                <div class="mcpeer-card p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $server['name'] ?? 'Unnamed Server' }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                                {{ $server['description'] ?? 'No description available' }}
                            </p>
                            
                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span>Port: {{ $server['port'] ?? 'N/A' }}</span>
                                <span>Version: {{ $server['version'] ?? '1.0.0' }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ ($server['status'] ?? 'inactive') === 'active' 
                                        ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' 
                                        : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                    {{ ucfirst($server['status'] ?? 'inactive') }}
                                </span>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('servers.show', ['server' => $server['id'] ?? 1]) }}" 
                                       class="text-yellow-500 hover:text-yellow-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('servers.edit', ['server' => $server['id'] ?? 1]) }}" 
                                       class="text-blue-500 hover:text-blue-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="mcpeer-icon-bg mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Nenhum servidor configurado</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">
                    Comece criando seu primeiro servidor MCP para gerenciar via API.
                </p>
                <a href="{{ route('servers.create') }}" class="mcpeer-btn-primary">
                    Criar Primeiro Servidor
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
