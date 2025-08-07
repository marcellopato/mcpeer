@extends('layouts.app')

@section('title', isset($server) ? 'Editar Servidor' : 'Novo Servidor')

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
                    {{ isset($server) ? 'Editar' : 'Novo Servidor' }}
                </li>
            </ol>
        </nav>
        <h1 class="text-3xl font-bold mcpeer-gradient-text">
            {{ isset($server) ? 'Editar Servidor MCP' : 'Criar Novo Servidor MCP' }}
        </h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            {{ isset($server) ? 'Modifique as configurações do seu servidor' : 'Configure um novo servidor Model Context Protocol' }}
        </p>
    </div>
    <a href="{{ route('mcp.servers') }}" class="mcpeer-btn-outline">
        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Voltar
    </a>
</div>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <form action="{{ isset($server) ? route('mcp.servers.update', $server) : route('mcp.servers.store') }}" 
              method="POST" 
              x-data="serverForm()" 
              class="space-y-8">
            @csrf
            @if(isset($server))
                @method('PUT')
            @endif

            <!-- Server Basic Information -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="mcpeer-icon-bg-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Informações Básicas</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nome do Servidor *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $server->name ?? '') }}"
                               placeholder="Ex: Servidor Principal"
                               class="mcpeer-input"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Identificador (Slug) *
                        </label>
                        <input type="text" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug', $server->slug ?? '') }}"
                               placeholder="servidor-principal"
                               class="mcpeer-input"
                               required>
                        <p class="mt-1 text-xs text-gray-500">Usado nas URLs e configurações</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Descrição
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              placeholder="Descreva a finalidade deste servidor MCP..."
                              class="mcpeer-textarea">{{ old('description', $server->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Server Configuration -->
            <div class="mcpeer-card p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="mcpeer-icon-bg-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Configuração</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="host" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Host *
                        </label>
                        <input type="text" 
                               id="host" 
                               name="host" 
                               value="{{ old('host', $server->host ?? 'localhost') }}"
                               placeholder="localhost"
                               class="mcpeer-input"
                               required>
                        @error('host')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="port" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Porta *
                        </label>
                        <input type="number" 
                               id="port" 
                               name="port" 
                               value="{{ old('port', $server->port ?? '8080') }}"
                               placeholder="8080"
                               min="1"
                               max="65535"
                               class="mcpeer-input"
                               required>
                        @error('port')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="transport" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tipo de Transporte *
                        </label>
                        <select id="transport" name="transport" class="mcpeer-select" required>
                            <option value="">Selecione o transporte</option>
                            <option value="stdio" {{ old('transport', $server->transport ?? '') == 'stdio' ? 'selected' : '' }}>STDIO</option>
                            <option value="http" {{ old('transport', $server->transport ?? '') == 'http' ? 'selected' : '' }}>HTTP</option>
                            <option value="websocket" {{ old('transport', $server->transport ?? '') == 'websocket' ? 'selected' : '' }}>WebSocket</option>
                        </select>
                        @error('transport')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="environment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Ambiente
                        </label>
                        <select id="environment" name="environment" class="mcpeer-select">
                            <option value="development" {{ old('environment', $server->environment ?? '') == 'development' ? 'selected' : '' }}>Desenvolvimento</option>
                            <option value="testing" {{ old('environment', $server->environment ?? '') == 'testing' ? 'selected' : '' }}>Teste</option>
                            <option value="production" {{ old('environment', $server->environment ?? '') == 'production' ? 'selected' : '' }}>Produção</option>
                        </select>
                        @error('environment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- MCP Actions -->
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
                    <button type="button" 
                            @click="addAction()" 
                            class="mcpeer-btn-primary text-sm">
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Adicionar Action
                    </button>
                </div>

                <div x-show="actions.length === 0" class="text-center py-8">
                    <div class="mcpeer-icon-bg mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Nenhuma action configurada</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Adicione ações MCP para definir as funcionalidades do servidor
                    </p>
                </div>

                <template x-for="(action, index) in actions" :key="index">
                    <div class="mcpeer-card-simple border-l-4 border-yellow-400 mb-4">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span x-text="action.type" 
                                      :class="{
                                          'mcp-action-query': action.type === 'query',
                                          'mcp-action-mutation': action.type === 'mutation',
                                          'mcp-action-stream': action.type === 'stream'
                                      }"></span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white" x-text="action.name || 'Nova Action'"></span>
                            </div>
                            <button type="button" 
                                    @click="removeAction(index)" 
                                    class="text-red-600 hover:text-red-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Tipo *
                                </label>
                                <select x-model="action.type" 
                                        :name="`actions[${index}][type]`"
                                        class="mcpeer-select text-sm" 
                                        required>
                                    <option value="">Selecione</option>
                                    <option value="query">Query</option>
                                    <option value="mutation">Mutation</option>
                                    <option value="stream">Stream</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Nome *
                                </label>
                                <input type="text" 
                                       x-model="action.name"
                                       :name="`actions[${index}][name]`"
                                       placeholder="Ex: get_user_profile"
                                       class="mcpeer-input text-sm" 
                                       required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Método PHP
                                </label>
                                <input type="text" 
                                       x-model="action.method"
                                       :name="`actions[${index}][method]`"
                                       placeholder="getUserProfile"
                                       class="mcpeer-input text-sm">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Descrição
                            </label>
                            <input type="text" 
                                   x-model="action.description"
                                   :name="`actions[${index}][description]`"
                                   placeholder="Descrição da funcionalidade..."
                                   class="mcpeer-input text-sm">
                        </div>
                    </div>
                </template>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('mcp.servers') }}" class="mcpeer-btn-outline">
                    Cancelar
                </a>
                <button type="submit" class="mcpeer-btn-primary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ isset($server) ? 'Atualizar Servidor' : 'Criar Servidor' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function serverForm() {
        return {
            actions: @json(old('actions', $server->actions ?? [])),
            
            addAction() {
                this.actions.push({
                    type: '',
                    name: '',
                    method: '',
                    description: ''
                });
            },
            
            removeAction(index) {
                this.actions.splice(index, 1);
            }
        }
    }
</script>
@endpush
@endsection
