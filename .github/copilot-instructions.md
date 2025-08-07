# MCPeer AI Coding Agent Instructions

## Project Overview

MCPeer is a **Laravel 10.x + Livewire** visual platform for creating and managing **Model Context Protocol (MCP) servers**. The system generates PHP backend code and Docker configurations from visual configurations.

## Core Architecture

### Domain Models (app/Models/)
- **MCPServer**: Main entity with `slug`, `port`, `status`, `capabilities[]`, `configuration[]`
- **MCPAction**: Belongs to MCPServer, defines `type` (query/mutation/stream), `method`, `endpoint`, `parameters[]`
- Key methods: `generateMCPConfig()`, `generateDockerConfig()`, `toMCPFormat()`

### Livewire Components (app/Livewire/)
- **MCPServerManager**: CRUD for servers, uses pagination, status toggle
- **MCPActionManager**: Manages actions for specific server, JSON parameter validation
- Both extend `$layout = 'components.layouts.app'` (required for proper rendering)

### Controller Pattern (app/Http/Controllers/)
- **MCPServerController**: RESTful + custom endpoints (`/export`, `/mcp-config`, `/test`)
- **MCPActionController**: Action management + testing functionality
- Controllers handle both API routes (`/api/*`) and web routes

## Development Workflows

### Docker Environment
- ALWAYS create a new branch
```bash
# Primary development setup
docker-compose up -d
docker-compose exec app php artisan migrate
docker-compose exec app php artisan test

# Manual testing endpoint
curl http://localhost:8080/backend-test.php
```

### Key Commands
- `php artisan serve` - Local development (port 8000)
- `npm run dev` - Vite asset compilation
- Tests: PHPUnit configured with `phpunit.xml.dist`

## MCPeer-Specific Patterns

### JSON Field Validation
Actions store complex data as JSON in database but validate as parsed arrays:
```php
// In Livewire components
if ($this->parametersJson) {
    $this->parameters = json_decode($this->parametersJson, true);
}
```

### MCP Generation Flow
1. User creates MCPServer via MCPServerManager Livewire component
2. Adds MCPActions via MCPActionManager component  
3. System auto-generates:
   - MCP JSON config via `generateMCPConfig()`
   - Docker config via `generateDockerConfig()`
   - PHP handler code via `generatePHPCode()`

### Status Management
- Servers have `status` field: 'active'/'inactive' (toggleable in UI)
- Actions have `is_active` boolean (filterable via `activeActions()` relationship)

### Routing Convention
- Web routes: `/mcp/servers`, `/mcp/servers/{server}/actions`
- API routes: `/api/mcp/*` for external integrations
- Special routes: `/backend-test.php` for core functionality testing

## Database Schema Patterns

### Polymorphic JSON Storage
- `MCPServer.capabilities` and `MCPServer.configuration` are JSON casts
- `MCPAction.parameters` and `MCPAction.headers` are JSON arrays
- Always validate JSON input in Livewire before saving

### Slug Generation
Both models auto-generate slugs on create:
```php
static::creating(function ($model) {
    if (empty($model->slug)) {
        $model->slug = Str::slug($model->name);
    }
});
```

## UI/Frontend Patterns

### TailwindCSS + Alpine.js
- Dark mode support: `dark:bg-gray-800` classes throughout
- Yellow accent color: `bg-yellow-500` for primary actions
- FontAwesome icons: `<i class="fas fa-*"></i>`

### Livewire Integration
- Real-time updates without page refresh
- JSON field editing with validation feedback
- Pagination built-in: `{{ $servers->links() }}`

## Testing Strategy

- Core functionality testable via `/backend-test.php`
- PHPUnit tests in `tests/` directory
- Docker builds tested in CI: `.github/workflows/ci.yml`
- Manual API testing through action test buttons in UI

### Stage and Commit
- Use `git add .` to stage changes
- Use `git commit -m "Your commit message"` to commit changes
- Delegate to CoPilot to do the code review and merge after all green

## Key Integration Points

- **Docker**: Primary deployment method, generates Dockerfile per server
- **Vite**: Asset compilation for CSS/JS
- **MySQL + Redis**: Data storage + caching via Docker Compose
- **MCP Protocol**: External integrations expect standardized JSON format

## Common Gotchas

- Livewire components MUST set `$layout = 'components.layouts.app'`
- JSON fields require both array property AND string representation for forms
- Port ranges: 1000-65535 for server ports
- Slug uniqueness handled automatically but check for conflicts
- Status toggles work via Livewire wire:click, not form submissions
