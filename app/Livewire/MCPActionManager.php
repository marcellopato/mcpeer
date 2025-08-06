<?php

namespace App\Livewire;

use App\Models\MCPServer;
use App\Models\MCPAction;
use Livewire\Component;
use Livewire\WithPagination;

class MCPActionManager extends Component
{
    use WithPagination;

    public MCPServer $server;
    public $showCreateForm = false;
    public $editingAction = null;
    
    // Form fields
    public $name = '';
    public $description = '';
    public $type = 'query';
    public $method = 'POST';
    public $endpoint = '';
    public $parameters = [];
    public $headers = [];
    public $requires_auth = false;
    public $auth_type = 'none';
    public $timeout = 30;
    
    // JSON representation fields
    public $parametersJson = '';
    public $authJson = '';

    // UI state
    public $showCodePreview = false;
    public $generatedCode = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'type' => 'required|in:query,mutation,stream',
        'method' => 'required|in:GET,POST,PUT,DELETE,PATCH',
        'endpoint' => 'required|url',
        'timeout' => 'required|integer|min:5|max:300',
    ];

    public function mount(MCPServer $server)
    {
        $this->server = $server;
    }

    public function render()
    {
        return view('livewire.mcp-action-manager', [
            'actions' => $this->server->actions()->paginate(10)
        ]);
    }

    public function createAction()
    {
        $this->showCreateForm = true;
        $this->resetForm();
    }

    public function saveAction()
    {
        $this->validate();

        // Parse JSON fields
        if ($this->parametersJson) {
            try {
                $this->parameters = json_decode($this->parametersJson, true);
            } catch (\Exception $e) {
                $this->addError('parametersJson', 'Invalid JSON format');
                return;
            }
        }

        $data = [
            'mcp_server_id' => $this->server->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'method' => $this->method,
            'endpoint' => $this->endpoint,
            'parameters' => $this->parameters,
            'headers' => $this->headers,
            'requires_auth' => $this->requires_auth,
            'auth_type' => $this->auth_type,
            'timeout' => $this->timeout,
        ];

        if ($this->editingAction) {
            $this->editingAction->update($data);
        } else {
            MCPAction::create($data);
        }

        $this->resetForm();
        $this->showCreateForm = false;
        $this->dispatch('action-saved');
    }

    public function editAction(MCPAction $action)
    {
        $this->editingAction = $action;
        $this->name = $action->name;
        $this->description = $action->description;
        $this->type = $action->type;
        $this->method = $action->method;
        $this->endpoint = $action->endpoint;
        $this->parameters = $action->parameters ?? [];
        $this->parametersJson = json_encode($action->parameters ?? [], JSON_PRETTY_PRINT);
        $this->headers = $action->headers ?? [];
        $this->requires_auth = $action->requires_auth;
        $this->auth_type = $action->auth_type;
        $this->timeout = $action->timeout;
        $this->showCreateForm = true;
    }

    public function deleteAction(MCPAction $action)
    {
        $action->delete();
        $this->dispatch('action-deleted');
    }

    public function toggleActive(MCPAction $action)
    {
        $action->update(['is_active' => !$action->is_active]);
    }

    public function testAction(MCPAction $action)
    {
        $result = $action->test();
        $this->dispatch('action-tested', $result);
    }

    public function previewCode(MCPAction $action)
    {
        $this->generatedCode = $action->generatePHPCode();
        $this->showCodePreview = true;
    }

    public function addParameter()
    {
        $this->parameters[] = ['name' => '', 'type' => 'string', 'required' => true, 'description' => ''];
    }

    public function removeParameter($index)
    {
        unset($this->parameters[$index]);
        $this->parameters = array_values($this->parameters);
    }

    public function addHeader()
    {
        $this->headers[] = ['name' => '', 'value' => ''];
    }

    public function removeHeader($index)
    {
        unset($this->headers[$index]);
        $this->headers = array_values($this->headers);
    }

    private function resetForm()
    {
        $this->reset([
            'editingAction', 'name', 'description', 'type', 'method', 
            'endpoint', 'parameters', 'parametersJson', 'headers', 'requires_auth', 
            'auth_type', 'authJson', 'timeout'
        ]);
        $this->type = 'query';
        $this->method = 'POST';
        $this->auth_type = 'none';
        $this->timeout = 30;
        $this->parametersJson = '';
        $this->authJson = '';
    }
}
