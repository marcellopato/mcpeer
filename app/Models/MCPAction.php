<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MCPAction extends Model
{
    use HasFactory;

    protected $table = 'mcp_actions';

    protected $fillable = [
        'mcp_server_id',
        'name',
        'slug',
        'description',
        'type',
        'method',
        'endpoint',
        'parameters',
        'headers',
        'body_template',
        'response_mapping',
        'validation_rules',
        'requires_auth',
        'auth_type',
        'auth_config',
        'is_active',
        'timeout',
    ];

    protected $casts = [
        'parameters' => 'array',
        'headers' => 'array',
        'body_template' => 'array',
        'response_mapping' => 'array',
        'auth_config' => 'array',
        'requires_auth' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($action) {
            if (empty($action->slug)) {
                $action->slug = Str::slug($action->name);
            }
        });
    }

    /**
     * Get the MCP server that owns this action.
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(MCPServer::class, 'mcp_server_id');
    }

    /**
     * Convert action to MCP format.
     */
    public function toMCPFormat(): array
    {
        return [
            'name' => $this->slug,
            'description' => $this->description,
            'type' => $this->type,
            'parameters' => $this->parameters ?? [],
            'handler' => [
                'method' => $this->method,
                'endpoint' => $this->endpoint,
                'headers' => $this->headers ?? [],
                'timeout' => $this->timeout,
            ],
            'auth' => $this->requires_auth ? [
                'type' => $this->auth_type,
                'config' => $this->auth_config ?? []
            ] : null,
            'validation' => $this->validation_rules,
            'response_mapping' => $this->response_mapping ?? []
        ];
    }

    /**
     * Generate PHP code for this action.
     */
    public function generatePHPCode(): string
    {
        $className = Str::studly($this->name) . 'Action';
        $methodName = Str::camel($this->name);
        
        return "<?php\n\n" .
               "class {$className}\n{\n" .
               "    public function {$methodName}(\$parameters = [])\n    {\n" .
               "        // MCP Action: {$this->name}\n" .
               "        // Type: {$this->type}\n" .
               "        // Endpoint: {$this->endpoint}\n\n" .
               "        \$client = new GuzzleHttp\\Client();\n\n" .
               "        \$response = \$client->request('{$this->method}', '{$this->endpoint}', [\n" .
               "            'json' => \$parameters,\n" .
               "            'timeout' => {$this->timeout},\n" .
               "        ]);\n\n" .
               "        return json_decode(\$response->getBody(), true);\n" .
               "    }\n}";
    }

    /**
     * Test the action with sample data.
     */
    public function test(array $parameters = []): array
    {
        // This would actually make the HTTP request
        // For now, return mock data
        return [
            'status' => 'success',
            'action' => $this->name,
            'type' => $this->type,
            'parameters' => $parameters,
            'response' => [
                'message' => 'Test successful',
                'data' => 'Mock response data'
            ]
        ];
    }
}
