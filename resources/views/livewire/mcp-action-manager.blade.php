<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Actions for {{ $server->name }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Define capabilities and endpoints for your MCP server
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('mcp.servers') }}" 
               class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Servers
            </a>
            <button wire:click="createAction" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-plus mr-2"></i>Add Action
            </button>
        </div>
    </div>

    <!-- Create/Edit Form -->
    @if ($showCreateForm)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $editingAction ? 'Edit Action' : 'Create New Action' }}
                </h3>
                <button wire:click="cancelEdit" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form wire:submit="saveAction" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Action Name *
                        </label>
                        <input type="text" 
                               wire:model="name" 
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="e.g., get_repositories">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Type *
                        </label>
                        <select wire:model="type" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">Select type...</option>
                            <option value="query">Query (Read data)</option>
                            <option value="mutation">Mutation (Write data)</option>
                            <option value="stream">Stream (Real-time)</option>
                        </select>
                        @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea wire:model="description" 
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                              placeholder="What does this action do?"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Endpoint -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Endpoint *
                    </label>
                    <input type="text" 
                           wire:model="endpoint" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                           placeholder="/api/repositories">
                    @error('endpoint') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Parameters -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Parameters (JSON)
                    </label>
                    <textarea wire:model="parametersJson" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                              placeholder='{
  "page": {"type": "integer", "default": 1},
  "limit": {"type": "integer", "default": 10}
}'></textarea>
                    @error('parametersJson') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Authentication -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Authentication (JSON)
                    </label>
                    <textarea wire:model="authJson" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                              placeholder='{
  "type": "bearer",
  "required": true
}'></textarea>
                    @error('authJson') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            wire:click="cancelEdit"
                            class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-medium transition-colors">
                        {{ $editingAction ? 'Update Action' : 'Create Action' }}
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Actions List -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        @if ($actions->count() > 0)
            <div class="space-y-4 p-6">
                @foreach ($actions as $action)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                               {{ $action->type === 'query' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                               {{ $action->type === 'mutation' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                               {{ $action->type === 'stream' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : '' }}">
                                        {{ strtoupper($action->type) }}
                                    </span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $action->name }}
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $action->endpoint }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button wire:click="toggleStatus({{ $action->id }})"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium cursor-pointer transition-colors
                                               {{ $action->is_active 
                                                  ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' 
                                                  : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                    {{ $action->is_active ? 'Active' : 'Inactive' }}
                                </button>

                                <button wire:click="editAction({{ $action->id }})" 
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="deleteAction({{ $action->id }})" 
                                        onclick="return confirm('Are you sure you want to delete this action?')"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200 p-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        @if ($action->description)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                {{ $action->description }}
                            </p>
                        @endif

                        <!-- Parameters Preview -->
                        @if ($action->parameters && count($action->parameters) > 0)
                            <div class="mb-3">
                                <h5 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Parameters:</h5>
                                <div class="flex flex-wrap gap-1">
                                    @foreach (array_keys($action->parameters) as $param)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                            {{ $param }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Generated Code Preview -->
                        <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                            <details class="group">
                                <summary class="cursor-pointer text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-yellow-600 dark:hover:text-yellow-400">
                                    <i class="fas fa-code mr-1"></i>View Generated Code
                                </summary>
                                <div class="mt-2 bg-gray-50 dark:bg-gray-900 rounded p-3">
                                    <pre class="text-xs text-gray-800 dark:text-gray-200 overflow-x-auto"><code>{{ $action->generatePHPCode() }}</code></pre>
                                </div>
                            </details>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700">
                {{ $actions->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 dark:text-gray-500 mb-4">
                    <i class="fas fa-puzzle-piece text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No actions yet</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Add your first action to define what this server can do.</p>
                <button wire:click="createAction" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg font-medium transition-colors">
                    Add Your First Action
                </button>
            </div>
        @endif
    </div>

    <!-- Server Config Preview -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
            <i class="fas fa-file-code mr-2"></i>Generated MCP Configuration
        </h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">MCP JSON Configuration:</h4>
                <div class="bg-gray-50 dark:bg-gray-900 rounded p-3">
                    <pre class="text-xs text-gray-800 dark:text-gray-200 overflow-x-auto"><code>{{ json_encode($server->generateMCPConfig(), JSON_PRETTY_PRINT) }}</code></pre>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Docker Configuration:</h4>
                <div class="bg-gray-50 dark:bg-gray-900 rounded p-3">
                    <pre class="text-xs text-gray-800 dark:text-gray-200 overflow-x-auto"><code>{{ $server->generateDockerConfig() }}</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
