@extends('layouts.app')

@section('title', 'Create API Server')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold mcpeer-gradient-text">Create New API Server</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Configure a new MCP server via API</p>
    </div>
    <a href="{{ route('servers.index') }}" class="mcpeer-btn-secondary">
        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Servers
    </a>
</div>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="mcpeer-card p-8">
            <form action="{{ route('servers.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Server Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Server Name *
                        </label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      focus:ring-2 focus:ring-yellow-500 focus:border-transparent
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="My MCP Server"
                               value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                         focus:ring-2 focus:ring-yellow-500 focus:border-transparent
                                         bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                  placeholder="Describe your MCP server...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Version -->
                    <div>
                        <label for="version" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Version *
                        </label>
                        <input type="text" id="version" name="version" required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      focus:ring-2 focus:ring-yellow-500 focus:border-transparent
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="1.0.0"
                               value="{{ old('version', '1.0.0') }}">
                        @error('version')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Author
                        </label>
                        <input type="text" id="author" name="author"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      focus:ring-2 focus:ring-yellow-500 focus:border-transparent
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="Your Name"
                               value="{{ old('author') }}">
                        @error('author')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Port -->
                    <div>
                        <label for="port" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Port *
                        </label>
                        <input type="number" id="port" name="port" required min="1000" max="65535"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                      focus:ring-2 focus:ring-yellow-500 focus:border-transparent
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="3000"
                               value="{{ old('port', 3000) }}">
                        @error('port')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('servers.index') }}" class="mcpeer-btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="mcpeer-btn-primary">
                            Create Server
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
