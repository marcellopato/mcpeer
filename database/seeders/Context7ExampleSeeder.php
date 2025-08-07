<?php

namespace Database\Seeders;

use App\Models\MCPServer;
use App\Models\MCPAction;
use Illuminate\Database\Seeder;

class Context7ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Context7 MCP Server example
        $context7Server = MCPServer::create([
            'name' => 'Context7 Documentation Server',
            'slug' => 'context7-docs',
            'description' => 'Access up-to-date, version-specific documentation and code examples directly from library sources. Powered by Context7 (Upstash).',
            'version' => '1.0.0',
            'author' => 'Upstash Team',
            'port' => 3001,
            'status' => 'active',
            'capabilities' => [
                'queries' => true,
                'mutations' => false,
                'streams' => true
            ],
            'configuration' => [
                'base_url' => 'https://mcp.context7.com',
                'api_version' => 'v1',
                'rate_limit' => 100,
                'timeout' => 30
            ]
        ]);

        // Query library documentation
        MCPAction::create([
            'mcp_server_id' => $context7Server->id,
            'name' => 'query_documentation',
            'slug' => 'query-documentation',
            'description' => 'Query documentation for specific libraries, frameworks, or APIs with version-specific examples',
            'type' => 'query',
            'method' => 'POST',
            'endpoint' => 'https://mcp.context7.com/mcp',
            'parameters' => [
                'library' => [
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Library name (e.g., "laravel", "react", "numpy")'
                ],
                'version' => [
                    'type' => 'string',
                    'required' => false,
                    'description' => 'Specific version (e.g., "10.x", "latest")'
                ],
                'query' => [
                    'type' => 'string',
                    'required' => true,
                    'description' => 'What you want to learn about'
                ],
                'include_examples' => [
                    'type' => 'boolean',
                    'required' => false,
                    'default' => true,
                    'description' => 'Include working code examples'
                ]
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => 'MCPeer/1.0.0'
            ],
            'requires_auth' => false,
            'auth_type' => 'none',
            'timeout' => 30,
            'is_active' => true
        ]);

        // Search across multiple libraries
        MCPAction::create([
            'mcp_server_id' => $context7Server->id,
            'name' => 'search_libraries',
            'slug' => 'search-libraries',
            'description' => 'Search across multiple libraries and frameworks for specific functionality or patterns',
            'type' => 'query',
            'method' => 'POST',
            'endpoint' => 'https://mcp.context7.com/mcp',
            'parameters' => [
                'search_term' => [
                    'type' => 'string',
                    'required' => true,
                    'description' => 'What functionality to search for'
                ],
                'languages' => [
                    'type' => 'array',
                    'required' => false,
                    'description' => 'Filter by programming languages',
                    'items' => ['php', 'javascript', 'python', 'java', 'rust']
                ],
                'categories' => [
                    'type' => 'array',
                    'required' => false,
                    'description' => 'Filter by categories',
                    'items' => ['web-framework', 'database', 'testing', 'ui', 'api']
                ],
                'limit' => [
                    'type' => 'integer',
                    'required' => false,
                    'default' => 10,
                    'description' => 'Number of results to return'
                ]
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => 'MCPeer/1.0.0'
            ],
            'requires_auth' => false,
            'auth_type' => 'none',
            'timeout' => 30,
            'is_active' => true
        ]);

        // Get library comparison
        MCPAction::create([
            'mcp_server_id' => $context7Server->id,
            'name' => 'compare_libraries',
            'slug' => 'compare-libraries',
            'description' => 'Compare multiple libraries or frameworks for specific use cases with pros/cons',
            'type' => 'query',
            'method' => 'POST',
            'endpoint' => 'https://mcp.context7.com/mcp',
            'parameters' => [
                'libraries' => [
                    'type' => 'array',
                    'required' => true,
                    'description' => 'List of libraries to compare',
                    'minimum' => 2,
                    'maximum' => 5
                ],
                'use_case' => [
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Specific use case or scenario'
                ],
                'criteria' => [
                    'type' => 'array',
                    'required' => false,
                    'description' => 'Comparison criteria',
                    'items' => ['performance', 'learning_curve', 'community', 'documentation', 'ecosystem']
                ]
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => 'MCPeer/1.0.0'
            ],
            'requires_auth' => false,
            'auth_type' => 'none',
            'timeout' => 45,
            'is_active' => true
        ]);

        // Stream real-time documentation updates
        MCPAction::create([
            'mcp_server_id' => $context7Server->id,
            'name' => 'stream_updates',
            'slug' => 'stream-updates',
            'description' => 'Stream real-time updates when documentation or library versions change',
            'type' => 'stream',
            'method' => 'GET',
            'endpoint' => 'https://mcp.context7.com/stream',
            'parameters' => [
                'libraries' => [
                    'type' => 'array',
                    'required' => true,
                    'description' => 'Libraries to monitor for updates'
                ],
                'update_types' => [
                    'type' => 'array',
                    'required' => false,
                    'description' => 'Types of updates to receive',
                    'items' => ['version', 'documentation', 'examples', 'deprecation']
                ]
            ],
            'headers' => [
                'Accept' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
                'User-Agent' => 'MCPeer/1.0.0'
            ],
            'requires_auth' => false,
            'auth_type' => 'none',
            'timeout' => 300,
            'is_active' => true
        ]);

        $this->command->info('✅ Context7 example server and actions created successfully!');
        $this->command->info('📊 Created:');
        $this->command->info('   - 1 MCP Server: Context7 Documentation Server');
        $this->command->info('   - 4 MCP Actions: query_documentation, search_libraries, compare_libraries, stream_updates');
    }
}
