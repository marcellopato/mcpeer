@extends('layouts.app')

@section('title', 'Context7 Integration Demo')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
            <i class="fas fa-cube text-yellow-500 mr-3"></i>Context7 Integration Demo
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">
            Experience how MCPeer manages external MCP servers with real Context7 integration
        </p>
        <div class="flex justify-center space-x-4">
            <a href="https://context7.com" target="_blank" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-external-link-alt mr-2"></i>Visit Context7
            </a>
            <a href="{{ route('mcp.servers') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Servers
            </a>
        </div>
    </div>

    <!-- Server Info -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                {{ $context7Server->name }}
            </h2>
            <span class="px-3 py-1 rounded-full text-sm font-medium 
                         {{ $context7Server->status === 'active' 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' 
                            : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                {{ ucfirst($context7Server->status) }}
            </span>
        </div>
        
        <p class="text-gray-600 dark:text-gray-400 mb-4">
            {{ $context7Server->description }}
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <h3 class="font-medium text-gray-900 dark:text-white mb-2">Version</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $context7Server->version }}</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <h3 class="font-medium text-gray-900 dark:text-white mb-2">Author</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $context7Server->author }}</p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <h3 class="font-medium text-gray-900 dark:text-white mb-2">Actions</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $actions->count() }} available</p>
            </div>
        </div>
    </div>

    <!-- Interactive Demo -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Query Documentation Demo -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-search text-yellow-500 mr-2"></i>Query Documentation
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Get up-to-date, version-specific documentation with working examples.
            </p>
            
            <form id="queryForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Library *
                    </label>
                    <select name="library" required 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="">Select a library...</option>
                        <option value="laravel">Laravel</option>
                        <option value="react">React</option>
                        <option value="vue">Vue.js</option>
                        <option value="express">Express.js</option>
                        <option value="fastapi">FastAPI</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        What do you want to learn?
                    </label>
                    <input type="text" name="query" required placeholder="e.g., routing, authentication, database"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Version
                        </label>
                        <input type="text" name="version" placeholder="latest" 
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    <div class="flex items-end">
                        <label class="flex items-center">
                            <input type="checkbox" name="include_examples" checked 
                                   class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Include examples</span>
                        </label>
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-search mr-2"></i>Query Documentation
                </button>
            </form>
            
            <!-- Query Results -->
            <div id="queryResults" class="mt-6 hidden">
                <h4 class="font-medium text-gray-900 dark:text-white mb-3">Results:</h4>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                    <div id="queryContent"></div>
                </div>
            </div>
        </div>

        <!-- Search Libraries Demo -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-globe text-blue-500 mr-2"></i>Search Libraries
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Search across multiple libraries for specific functionality.
            </p>
            
            <form id="searchForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Search Term *
                    </label>
                    <input type="text" name="search_term" required placeholder="e.g., web framework, database ORM"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Filter by Languages
                    </label>
                    <div class="flex flex-wrap gap-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="languages[]" value="php" 
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">PHP</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="languages[]" value="javascript" 
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">JavaScript</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="languages[]" value="python" 
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Python</span>
                        </label>
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-search mr-2"></i>Search Libraries
                </button>
            </form>
            
            <!-- Search Results -->
            <div id="searchResults" class="mt-6 hidden">
                <h4 class="font-medium text-gray-900 dark:text-white mb-3">Results:</h4>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                    <div id="searchContent"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Actions -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
            Available MCP Actions
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($actions as $action)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-medium text-gray-900 dark:text-white">
                            {{ $action->name }}
                        </h3>
                        <span class="px-2 py-1 rounded text-xs font-medium
                                     {{ $action->type === 'query' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                     {{ $action->type === 'mutation' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                     {{ $action->type === 'stream' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : '' }}">
                            {{ $action->type }}
                        </span>
                    </div>
                    
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        {{ $action->description }}
                    </p>
                    
                    <div class="text-xs text-gray-500 dark:text-gray-500">
                        <div>Method: {{ $action->method }}</div>
                        <div>Timeout: {{ $action->timeout }}s</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Query form handler
    document.getElementById('queryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = {
            library: formData.get('library'),
            query: formData.get('query'),
            version: formData.get('version') || 'latest',
            include_examples: formData.has('include_examples')
        };
        
        fetch('{{ route("context7.demo.query") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            const resultsDiv = document.getElementById('queryResults');
            const contentDiv = document.getElementById('queryContent');
            
            if (result.success) {
                contentDiv.innerHTML = `
                    <h5 class="font-medium text-gray-900 dark:text-white mb-2">${result.data.documentation}</h5>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">${result.data.description}</p>
                    ${result.data.examples.length > 0 ? `
                        <div class="space-y-3">
                            <h6 class="font-medium text-gray-900 dark:text-white">Examples:</h6>
                            ${result.data.examples.map(example => `
                                <div class="bg-gray-900 rounded p-3">
                                    <div class="text-sm text-gray-300 mb-1">${example.title}</div>
                                    <pre class="text-sm text-green-400"><code>${example.code}</code></pre>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                `;
                resultsDiv.classList.remove('hidden');
            } else {
                contentDiv.innerHTML = `<div class="text-red-600 dark:text-red-400">Error: ${result.error}</div>`;
                resultsDiv.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    
    // Search form handler
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = {
            search_term: formData.get('search_term'),
            languages: formData.getAll('languages[]')
        };
        
        fetch('{{ route("context7.demo.search") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            const resultsDiv = document.getElementById('searchResults');
            const contentDiv = document.getElementById('searchContent');
            
            if (result.success) {
                contentDiv.innerHTML = `
                    <div class="space-y-3">
                        ${result.data.results.map(item => `
                            <div class="border border-gray-200 dark:border-gray-600 rounded p-3">
                                <div class="flex justify-between items-start mb-2">
                                    <h6 class="font-medium text-gray-900 dark:text-white">${item.library}</h6>
                                    <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">${item.language}</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">${item.description}</p>
                                <div class="text-xs text-gray-500 dark:text-gray-500">
                                    Relevance: ${Math.round(item.relevance * 100)}% - ${item.match_reason}
                                </div>
                            </div>
                        `).join('')}
                    </div>
                `;
                resultsDiv.classList.remove('hidden');
            } else {
                contentDiv.innerHTML = `<div class="text-red-600 dark:text-red-400">Error: ${result.error}</div>`;
                resultsDiv.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>
@endsection
