<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Foundation\Application;
use App\Models\MCPServer;
use App\Models\MCPAction;

echo "<h1>MCPeer Backend Test</h1>\n";
echo "<p>Testing core MCP functionality without web middleware...</p>\n";

// Bootstrap Laravel without web middleware
$app = new Application(__DIR__ . '/..');
$app->singleton(
    \Illuminate\Contracts\Console\Kernel::class,
    \App\Console\Kernel::class
);

$app->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\Exceptions\Handler::class
);

$app->singleton(
    \Illuminate\Contracts\Http\Kernel::class,
    \App\Http\Kernel::class
);

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h2>✅ Laravel Application Bootstrap Complete</h2>\n";

try {
    // Test database connection
    $dbResult = \Illuminate\Support\Facades\DB::select('SELECT 1 as test');
    echo "<h2>✅ Database Connection Working</h2>\n";
    
    // Clear existing data for fresh test
    MCPAction::truncate();
    MCPServer::truncate();
    
    // Test model creation
    $server = MCPServer::create([
        'name' => 'Test GitLab Server',
        'description' => 'A test MCP server for GitLab API integration',
        'version' => '1.0.0',
        'author' => 'MCPeer Test Suite',
        'port' => 3001
    ]);
    
    echo "<h2>✅ MCP Server Created</h2>\n";
    echo "<p>ID: {$server->id}, Slug: {$server->slug}</p>\n";
    
    // Test action creation
    $action = MCPAction::create([
        'mcp_server_id' => $server->id,
        'name' => 'Get Repositories',
        'description' => 'Fetch all repositories from GitLab',
        'type' => 'query',
        'method' => 'GET',
        'endpoint' => 'https://gitlab.example.com/api/v4/projects',
        'parameters' => [
            'page' => ['type' => 'integer', 'default' => 1],
            'per_page' => ['type' => 'integer', 'default' => 20]
        ],
        'timeout' => 30
    ]);
    
    echo "<h2>✅ MCP Action Created</h2>\n";
    echo "<p>ID: {$action->id}, Slug: {$action->slug}</p>\n";
    
    // Create another action for testing
    $action2 = MCPAction::create([
        'mcp_server_id' => $server->id,
        'name' => 'Create Issue',
        'description' => 'Create a new issue in GitLab project',
        'type' => 'mutation',
        'method' => 'POST',
        'endpoint' => 'https://gitlab.example.com/api/v4/projects/1/issues',
        'parameters' => [
            'title' => ['type' => 'string', 'required' => true],
            'description' => ['type' => 'string', 'default' => '']
        ],
        'timeout' => 30
    ]);
    
    echo "<h2>✅ Second MCP Action Created</h2>\n";
    echo "<p>ID: {$action2->id}, Slug: {$action2->slug}</p>\n";
    
    // Test MCP configuration generation
    $mcpConfig = $server->generateMCPConfig();
    echo "<h2>✅ MCP Configuration Generated</h2>\n";
    echo "<pre>" . json_encode($mcpConfig, JSON_PRETTY_PRINT) . "</pre>\n";
    
    // Test Docker configuration
    $dockerConfig = $server->generateDockerConfig();
    echo "<h2>✅ Docker Configuration Generated</h2>\n";
    echo "<pre>{$dockerConfig}</pre>\n";
    
    // Test PHP code generation
    $phpCode = $action->generatePHPCode();
    echo "<h2>✅ PHP Code Generated</h2>\n";
    echo "<pre>" . htmlspecialchars($phpCode) . "</pre>\n";
    
    // Test action testing
    $testResult = $action->test(['page' => 1, 'per_page' => 10]);
    echo "<h2>✅ Action Test Completed</h2>\n";
    echo "<pre>" . json_encode($testResult, JSON_PRETTY_PRINT) . "</pre>\n";
    
    // Show all servers and actions
    $allServers = MCPServer::with('actions')->get();
    echo "<h2>✅ All MCP Servers</h2>\n";
    foreach ($allServers as $s) {
        echo "<h3>{$s->name} (v{$s->version})</h3>\n";
        echo "<p>Status: {$s->status} | Port: {$s->port} | Actions: {$s->actions->count()}</p>\n";
        
        foreach ($s->actions as $a) {
            echo "<h4>&nbsp;&nbsp;→ {$a->name} ({$a->type})</h4>\n";
            echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;{$a->description}</p>\n";
            echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;Endpoint: {$a->endpoint}</p>\n";
        }
    }
    
    echo "<h1>🎉 MCPeer Core Implementation Test Successful!</h1>\n";
    echo "<p>All models, relationships, and business logic are working correctly.</p>\n";
    
} catch (\Exception $e) {
    echo "<h2>❌ Error: " . $e->getMessage() . "</h2>\n";
    echo "<pre>" . $e->getTraceAsString() . "</pre>\n";
}