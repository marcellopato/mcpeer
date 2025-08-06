<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-6 lg:p-8">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                            Bem-vindo ao MCPeer!
                        </div>
                    </div>
                    
                    <div class="mt-6 text-gray-500 dark:text-gray-400">
                        <p class="mb-4">
                            O MCPeer é sua plataforma para criar e gerenciar servidores Model Context Protocol (MCP) de forma visual e intuitiva.
                        </p>
                        <p>
                            Comece criando suas primeiras ações MCP ou explorando os servidores disponíveis.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- MCP Actions Card -->
                <div class="card p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <a href="{{ route('mcp.servers') }}" class="text-primary-600 dark:text-primary-400 text-sm font-medium hover:underline">
                            Criar primeira ação →
                        </a>
                    </div>
                </div>
                
                <!-- Active Servers Card -->
                <div class="card p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <a href="{{ route('mcp.servers') }}" class="text-primary-600 dark:text-primary-400 text-sm font-medium hover:underline">
                            Ver servidores →
                        </a>
                    </div>
                </div>
                
                <!-- API Integrations Card -->
                <div class="card p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="card p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Ações Rápidas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('mcp.servers') }}" 
                       class="block p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-primary-500 dark:hover:border-primary-400 transition-colors">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <h4 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Nova Ação MCP</h4>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Criar uma nova ação para seu servidor MCP</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('mcp.servers') }}" 
                       class="block p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-primary-500 dark:hover:border-primary-400 transition-colors">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h3a2 2 0 012 2v11a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2h3z" />
                            </svg>
                            <h4 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Novo Servidor</h4>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Configurar um novo servidor MCP</p>
                        </div>
                    </a>
                    
                    <div class="block p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg opacity-50">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5l-2-2m0 0l-2 2m2-2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2h2m10 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h10z" />
                            </svg>
                            <h4 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Documentação</h4>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Em breve - Guias e exemplos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
