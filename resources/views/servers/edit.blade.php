@extends('layouts.app')

@section('title', 'Edit API Server')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold mcpeer-gradient-text">Edit API Server</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Update server configuration</p>
    </div>
    <div class="flex space-x-4">
        <a href="{{ route('servers.show', $server) }}" class="mcpeer-btn-secondary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            View Details
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
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="mcpeer-card p-8">
            <form action="{{ route('servers.update', $server) }}" method="POST">
                @csrf
                @method('PUT')
                
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
                               value="{{ old('name', $server['name'] ?? '') }}">
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
                                  placeholder="Describe your MCP server...">{{ old('description', $server['description'] ?? '') }}</textarea>
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
                               value="{{ old('version', $server['version'] ?? '1.0.0') }}">
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
                               value="{{ old('author', $server['author'] ?? '') }}">
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
                               value="{{ old('port', $server['port'] ?? 3000) }}">
                        @error('port')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status
                        </label>
                        <select id="status" name="status"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg 
                                       focus:ring-2 focus:ring-yellow-500 focus:border-transparent
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="active" {{ old('status', $server['status'] ?? 'inactive') === 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ old('status', $server['status'] ?? 'inactive') === 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('servers.show', $server) }}" class="mcpeer-btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="mcpeer-btn-primary">
                            Update Server
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
