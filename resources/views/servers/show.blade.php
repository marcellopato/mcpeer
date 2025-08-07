@extends('layouts.app')

@section('title', 'Server Details')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold mcpeer-gradient-text">Server Details</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">View server configuration and status</p>
    </div>
    <div class="flex space-x-4">
        <a href="{{ route('servers.edit', $server) }}" class="mcpeer-btn-secondary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
        </a>
        <a href="{{ route('servers.index') }}" class="mcpeer-btn-primary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Servers
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Server Info Card -->
        <div class="mcpeer-card p-8 mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Basic Information</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Name</label>
                            <p class="text-lg text-gray-900 dark:text-white">{{ $server['name'] ?? 'Unnamed Server' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Description</label>
                            <p class="text-gray-900 dark:text-white">{{ $server['description'] ?? 'No description available' }}</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Version</label>
                                <p class="text-gray-900 dark:text-white">{{ $server['version'] ?? '1.0.0' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Author</label>
                                <p class="text-gray-900 dark:text-white">{{ $server['author'] ?? 'Unknown' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Status & Configuration -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status & Configuration</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ ($server['status'] ?? 'inactive') === 'active' 
                                    ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' 
                                    : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                {{ ucfirst($server['status'] ?? 'inactive') }}
                            </span>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Port</label>
                            <p class="text-gray-900 dark:text-white">{{ $server['port'] ?? 'Not configured' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Created</label>
                            <p class="text-gray-900 dark:text-white">{{ $server['created_at'] ?? 'Unknown' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</label>
                            <p class="text-gray-900 dark:text-white">{{ $server['updated_at'] ?? 'Unknown' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Server Configuration (JSON Format) -->
        <div class="mcpeer-card p-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Server Configuration (JSON)</h3>
            
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                <pre class="text-sm text-gray-800 dark:text-gray-200 overflow-x-auto"><code>{
  "name": "{{ $server['name'] ?? 'unnamed' }}",
  "description": "{{ $server['description'] ?? '' }}",
  "version": "{{ $server['version'] ?? '1.0.0' }}",
  "author": "{{ $server['author'] ?? '' }}",
  "port": {{ $server['port'] ?? 3000 }},
  "status": "{{ $server['status'] ?? 'inactive' }}",
  "capabilities": {
    "prompts": true,
    "resources": true,
    "tools": true
  },
  "endpoints": {
    "prompts": "/api/prompts",
    "resources": "/api/resources", 
    "tools": "/api/tools"
  }
}</code></pre>
            </div>
        </div>
        
        <!-- Danger Zone -->
        <div class="mcpeer-card p-8 border-red-200 dark:border-red-800">
            <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4">Danger Zone</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
                Once you delete this server, there is no going back. Please be certain.
            </p>
            <form action="{{ route('servers.destroy', $server) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Are you sure you want to delete this server? This action cannot be undone.')"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Delete Server
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
