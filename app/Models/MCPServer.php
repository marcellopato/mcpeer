<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MCPServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'version',
        'author',
        'capabilities',
        'configuration',
        'status',
        'docker_image',
        'port',
    ];

    protected $casts = [
        'capabilities' => 'array',
        'configuration' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($server) {
            if (empty($server->slug)) {
                $server->slug = Str::slug($server->name);
            }
        });
    }

    /**
     * Get the MCP actions for this server.
     */
    public function actions(): HasMany
    {
        return $this->hasMany(MCPAction::class);
    }

    /**
     * Get active actions only.
     */
    public function activeActions(): HasMany
    {
        return $this->actions()->where('is_active', true);
    }

    /**
     * Generate MCP server configuration.
     */
    public function generateMCPConfig(): array
    {
        $config = [
            'name' => $this->name,
            'version' => $this->version,
            'description' => $this->description,
            'author' => $this->author,
            'capabilities' => $this->capabilities ?? [
                'queries' => $this->activeActions()->where('type', 'query')->count() > 0,
                'mutations' => $this->activeActions()->where('type', 'mutation')->count() > 0,
                'streams' => $this->activeActions()->where('type', 'stream')->count() > 0,
            ],
            'actions' => []
        ];

        foreach ($this->activeActions as $action) {
            $config['actions'][] = $action->toMCPFormat();
        }

        return $config;
    }

    /**
     * Generate Docker configuration.
     */
    public function generateDockerConfig(): string
    {
        return "FROM php:8.1-fpm\n" .
               "WORKDIR /app\n" .
               "COPY . /app\n" .
               "RUN composer install\n" .
               "EXPOSE {$this->port}\n" .
               "CMD [\"php\", \"artisan\", \"serve\", \"--host=0.0.0.0\", \"--port={$this->port}\"]";
    }
}
