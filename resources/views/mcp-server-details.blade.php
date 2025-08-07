@extends('layouts.app')

@section('title', $server->name)

@section('header')
<div class="flex justify-between items-center">
    <div>
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('mcp.servers') }}" class="text-gray-500 hover:text-yellow-600 transition-colors">
                        MCP Servers
                    </a>
                </li>
                <li>
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </li>
                <li class="text-gray-900 dark:text-white">
                    {{ $server->name }}
                </li>
            </ol>
        </nav>
        <div class="flex items-center space-x-4">
            <div class="mcpeer-icon-bg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5 5L20 7" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $server->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400">{{ $server->description }}</p>
                <div class="flex items-center space-x-4 mt-2">
                    <span class="status-online">Online</span>
                    <span class="text-sm text-gray-500">Uptime: 24h 15m</span>
                    <span class="text-sm text-gray-500">{{ $server->actions->count() }} actions</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex space-x-3">
        <button class="mcpeer-btn-outline">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Exportar Config
        </button>
        <a href="{{ route('mcp.servers.edit', $server) }}" class="mcpeer-btn-primary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            Editar
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="mcpeer-icon-bg-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a1 1 0 01-2 2h-2a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Requests Hoje</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">247</p>
                    </div>
                </div>
            </div>
            
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-400 rounded-lg flex items-center justify-center text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tempo Médio</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">45ms</p>
                    </div>
                </div>
            </div>
            
            <div class="mcpeer-card p-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-red-400 rounded-lg flex items-center justify-center text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Taxa de Erro</p>
                        <p class="text-2xl font-semibold text-green-600">0.1%</p>
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
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Actions Ativas</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $server->actions->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Server Configuration -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="mcpeer-icon-bg-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Configuração do Servidor</h2>
                </div>
                
                <div class="mcpeer-code">
                    <div class="text-sm">
                        <div class="mb-3">
                            <div class="text-yellow-400 font-medium">Server Configuration:</div>
                        </div>
                        <div class="ml-4 space-y-1">
                            <div><span class="text-yellow-400">host:</span> {{ $server->host }}</div>
                            <div><span class="text-yellow-400">port:</span> {{ $server->port }}</div>
                            <div><span class="text-yellow-400">transport:</span> {{ $server->transport }}</div>
                            <div><span class="text-yellow-400">environment:</span> {{ $server->environment }}</div>
                            <div><span class="text-yellow-400">status:</span> <span class="text-green-400">active</span></div>
                        </div>
                        
                        <div class="mt-4 mb-3">
                            <div class="text-yellow-400 font-medium">Docker Compose:</div>
                        </div>
                        <div class="ml-4 space-y-1">
                            <div><span class="text-yellow-400">image:</span> mcpeer/{{ $server->slug }}:latest</div>
                            <div><span class="text-yellow-400">ports:</span> "{{ $server->port }}:{{ $server->port }}"</div>
                            <div><span class="text-yellow-400">restart:</span> unless-stopped</div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex space-x-3">
                    <button class="mcpeer-btn-outline text-sm">
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Copiar Config
                    </button>
                    <button class="mcpeer-btn-outline text-sm">
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download
                    </button>
                </div>
            </div>

            <!-- Server Actions -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="mcpeer-icon-bg-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">MCP Actions</h2>
                    </div>
                    <a href="{{ route('mcp.actions.create', $server) }}" class="mcpeer-btn-primary text-sm">
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Nova Action
                    </a>
                </div>

                @if($server->actions->count() > 0)
                    <div class="space-y-4">
                        @foreach($server->actions as $action)
                            <div class="mcpeer-card-simple border-l-4 
                                @if($action->type === 'query') border-yellow-400 
                                @elseif($action->type === 'mutation') border-blue-400 
                                @else border-purple-400 @endif">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <span class="
                                            @if($action->type === 'query') mcp-action-query 
                                            @elseif($action->type === 'mutation') mcp-action-mutation 
                                            @else mcp-action-stream @endif">
                                            {{ $action->type }}
                                        </span>
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $action->name }}</h4>
                                            @if($action->description)
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $action->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-400 hover:text-yellow-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8a1 1 0 001-1V8a1 1 0 00-1-1H8a1 1 0 00-1 1v5a1 1 0 001 1z" />
                                            </svg>
                                        </button>
                                        <button class="text-gray-400 hover:text-yellow-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="mcpeer-icon-bg mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Nenhuma action configurada</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                            Adicione ações MCP para definir as funcionalidades do servidor
                        </p>
                        <a href="{{ route('mcp.actions.create', $server) }}" class="mcpeer-btn-primary">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Criar Primeira Action
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mcpeer-card p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="mcpeer-icon-bg-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Atividade Recente</h2>
            </div>

            <div class="overflow-hidden">
                <table class="mcpeer-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Action</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>14:23:15</td>
                            <td>
                                <span class="mcp-action-query">get_user_profile</span>
                            </td>
                            <td class="font-mono text-xs">getUserProfile()</td>
                            <td>
                                <span class="status-online">Success</span>
                            </td>
                            <td>42ms</td>
                        </tr>
                        <tr>
                            <td>14:22:58</td>
                            <td>
                                <span class="mcp-action-mutation">create_task</span>
                            </td>
                            <td class="font-mono text-xs">createTask()</td>
                            <td>
                                <span class="status-online">Success</span>
                            </td>
                            <td>127ms</td>
                        </tr>
                        <tr>
                            <td>14:22:30</td>
                            <td>
                                <span class="mcp-action-stream">live_notifications</span>
                            </td>
                            <td class="font-mono text-xs">liveNotifications()</td>
                            <td>
                                <span class="status-testing">Streaming</span>
                            </td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>14:21:45</td>
                            <td>
                                <span class="mcp-action-query">get_user_profile</span>
                            </td>
                            <td class="font-mono text-xs">getUserProfile()</td>
                            <td>
                                <span class="status-offline">Error</span>
                            </td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-center">
                <button class="mcpeer-btn-outline">
                    Ver Todos os Logs
                </button>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="mcpeer-card border-red-200 dark:border-red-800 p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-red-600 dark:text-red-400">Zona de Perigo</h2>
            </div>
            
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <h3 class="font-medium text-red-800 dark:text-red-200 mb-2">Excluir Servidor</h3>
                <p class="text-sm text-red-600 dark:text-red-300 mb-4">
                    Esta ação é irreversível. Todos os dados, configurações e actions relacionadas a este servidor serão permanentemente removidos.
                </p>
                <form action="{{ route('mcp.servers.destroy', $server) }}" method="POST" 
                      onsubmit="return confirm('Tem certeza que deseja excluir este servidor? Esta ação não pode ser desfeita.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mcpeer-btn-danger">
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Excluir Servidor
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
